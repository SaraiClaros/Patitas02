<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\MascotaAdopcionController;
use App\Http\Controllers\ReaccionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\VacunacionController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\CampanaEsterilizacionController;
use App\Http\Controllers\SolicitudCEController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\SeguirController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\MensajesController;
use App\Livewire\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Route;


// Redirigir raíz a login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas protegidas por auth
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Publicaciones (resource, excluyendo show)
    Route::resource('publicaciones', PublicacionController::class)
        ->except(['show']);

    // AJAX: comentarios
    Route::post('/publicaciones/{publicacion}/comentarios', [ComentarioController::class, 'store'])
        ->name('comentarios.store');

    // AJAX: reacciones (Love)
    Route::post('/publicaciones/{publicacion}/reaccion/love', [ReaccionController::class, 'toggleLove'])
        ->name('reacciones.love');

    // AJAX: compartir publicación
    Route::post('/publicaciones/{publicacion}/compartir', [PublicacionController::class, 'compartir'])
        ->name('publicaciones.compartir');

    // AJAX: seguir usuario
    Route::post('/usuarios/{user}/seguir', [SeguirController::class, 'toggle'])->name('usuarios.seguir')->middleware('auth');


    // Ver todos los comentarios de una publicación
    Route::get('/publicaciones/{publicacion}/comentarios-todos', function(App\Models\Publicacion $publicacion) {
        $comentarios = $publicacion->comentarios()->with('user')->latest()->get();
        return $comentarios->map(function($c) {
            return [
                'id' => $c->id,
                'user_name' => $c->user->name,
                'contenido' => $c->contenido,
            ];
        });
    })->name('comentarios.todos');

    // Campañas de esterilización
    Route::get('/campanas/publicacion', [CampanaEsterilizacionController::class, 'publicacion'])
        ->name('campanas.publicacion');
    Route::resource('campanas', CampanaEsterilizacionController::class);

    // Otras resources
    Route::resource('consultas', ConsultaController::class);
    Route::resource('vacunaciones', VacunacionController::class);
    Route::resource('tratamientos', TratamientoController::class);
    Route::resource('mascotas', MascotaController::class);
    Route::resource('historial', HistorialMedicoController::class);
    Route::resource('duenos', DuenoController::class);
    Route::resource('solicitudes', SolicitudCEController::class);

    // Notificaciones
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::get('/notificaciones/leer/{id}', [NotificacionController::class, 'leer'])->name('notificaciones.leer');

});

// Adopción de mascotas
Route::get('/adopta/crear', [MascotaAdopcionController::class, 'create'])->name('mascotaAdopcion.create');
Route::post('/adopta/guardar', [MascotaAdopcionController::class, 'store'])->name('mascotas.store');
Route::get('/adopta', [MascotaAdopcionController::class, 'index'])->name('adopta.index');

// Búsqueda
Route::get('/busqueda', [BusquedaController::class, 'index'])->name('busqueda');
Route::get('/perfil/{user}', [PublicacionController::class, 'perfil'])->name('perfil.show');


Route::get('/mensajes', [MensajesController::class, 'index'])
    ->name('mensajes.usuarios')
    ->middleware('auth');

// Chat con usuario específico usando Livewire
Route::get('/chat/{receiverId}', Chat::class)->middleware('auth')->name('chat');

// Requerido por Laravel auth
require __DIR__.'/auth.php';
