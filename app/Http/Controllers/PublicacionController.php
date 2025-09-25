<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\User;
use App\Models\Compartido;
use App\Models\Reaccion;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    // Mostrar listado de publicaciones
    public function index()
    {
        $publicaciones = Publicacion::with([
            'user',
            'comentarios.user',
            'reacciones' => fn($q) => $q->where('tipo', 'love'),
            'compartidos.user'
        ])
        ->latest()
        ->paginate(6);

        if (auth()->check()) {
            auth()->user()->load('siguiendo');
        }

        return view('publicaciones.index', compact('publicaciones'));
    }

    // Formulario para crear publicación
    public function create()
    {
        return view('publicaciones.create');
    }

    // Guardar nueva publicación
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,webm|max:10240',
        ]);

        $publicacion = new Publicacion();
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->user_id = Auth::id();

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('publicaciones', 'public');
            $publicacion->media = str_replace('public/', '', $mediaPath);
        }

        $publicacion->save();

        return redirect()->route('publicaciones.index')->with('success', '¡Publicación creada correctamente!');
    }

    // Compartir publicación
    public function compartir(Publicacion $publicacion)
    {
        $user = auth()->user();

        $publicacion->compartidos()->firstOrCreate([
            'user_id' => $user->id
        ]);

        if(request()->ajax()){
            return response()->json([
                'count' => $publicacion->compartidos()->count()
            ]);
        }

        return back()->with('success', 'Publicación compartida.');
    }

    // Like (love)
    public function love(Publicacion $publicacion)
    {
        $user = auth()->user();

        $yaDioLike = $publicacion->reacciones()
            ->where('user_id', $user->id)
            ->where('tipo', 'love')
            ->exists();

        if ($yaDioLike) {
            // quitar like
            $publicacion->reacciones()
                ->where('user_id', $user->id)
                ->where('tipo', 'love')
                ->delete();
            $liked = false;
        } else {
            // dar like
            $publicacion->reacciones()->create([
                'user_id' => $user->id,
                'tipo' => 'love'
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $publicacion->reacciones()->where('tipo', 'love')->count()
        ]);
    }

    // Evitar acceso a show individual
    public function show($id)
    {
        abort(404);
    }

    // Editar publicación
    public function edit($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $this->authorize('update', $publicacion);
        return view('publicaciones.edit', compact('publicacion'));
    }

    // Actualizar publicación
    public function update(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $this->authorize('update', $publicacion);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $publicacion->update($request->only(['titulo', 'descripcion']));
        return redirect()->route('publicaciones.index')->with('success', 'Publicación actualizada.');
    }

    // Eliminar publicación
    public function destroy(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $this->authorize('delete', $publicacion);

        $publicacion->delete();
        return response()->json(['success' => true]);
    }

    // Perfil de usuario
    public function perfil(User $user)
    {
        // Publicaciones propias
        $publicacionesPropias = Publicacion::with([
            'user',
            'comentarios.user',
            'reacciones' => fn($q) => $q->where('tipo','love'),
            'compartidos.user'
        ])->where('user_id', $user->id);

        // Publicaciones compartidas
        $publicacionesCompartidas = Publicacion::with([
            'user',
            'comentarios.user',
            'reacciones' => fn($q) => $q->where('tipo','love'),
            'compartidos.user'
        ])->whereHas('compartidos', fn($q) => $q->where('user_id', $user->id))
          ->get()
          ->map(function($pub){
              $pub->compartidoPor = $pub->compartidos->where('user_id', auth()->id())->first()->user ?? null;
              return $pub;
          });

        // Combinar ambas colecciones
        $publicaciones = $publicacionesPropias->get()->merge($publicacionesCompartidas)
                                ->sortByDesc(fn($p) => $p->created_at);

        return view('publicaciones.index', compact('publicaciones', 'user'));
    }
}