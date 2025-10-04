import './bootstrap';

window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log('Nuevo mensaje recibido:', e);

        // Avisar a Livewire que hay mensaje nuevo
        Livewire.dispatch('message-received');
    });
