<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

#[\Livewire\Attributes\Layout('layouts.navigation')]
class Chat extends Component
{
    use WithFileUploads;

    public $chatMessages;    // Mensajes del chat
    public $newMessage = ''; // Texto del mensaje
    public $receiverId;      // Usuario receptor
    public $file;            // Archivo a enviar

    public function mount($receiverId)
    {
        $this->receiverId = $receiverId;
        $this->loadMessages();
    }

    // Carga los últimos 50 mensajes entre los dos usuarios (más recientes primero)
    public function loadMessages()
    {
        $this->chatMessages = Message::with('user')
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->where('receiver_id', $this->receiverId);
            })
            ->orWhere(function ($q) {
                $q->where('user_id', $this->receiverId)
                  ->where('receiver_id', Auth::id());
            })
            ->latest()   // más nuevos primero
            ->take(50)
            ->get();
    }

    // Enviar un mensaje
    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'nullable|string|max:1000',
            'file' => 'nullable|file|max:10240', // máximo 10MB
        ]);

        $filePath = null;

        if ($this->file) {
            $filePath = $this->file->store('chat_files', 'public');
        }

        $message = Message::create([
            'user_id' => Auth::id(),
            'receiver_id' => $this->receiverId,
            'body' => $this->newMessage ?: null,
            'file_path' => $filePath,
        ]);

        // Añadir al inicio del listado porque es el más nuevo
        $this->chatMessages->prepend($message->load('user'));

        $this->newMessage = '';
        $this->file = null;
    }

    // Eliminar un mensaje
    public function deleteMessage($id)
    {
        $message = Message::find($id);

        if ($message && $message->user_id === Auth::id()) {
            if ($message->file_path && \Storage::disk('public')->exists($message->file_path)) {
                \Storage::disk('public')->delete($message->file_path);
            }

            $message->delete();
            $this->loadMessages();
        }
    }

    public function render()
    {
        return view('livewire.chat');
    }
}