<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\MascotaAdopcionController;
use App\Http\Controllers\ReaccionController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/publicaciones.index', function () {
    return view('publicaciones.index');
})->middleware(['auth', 'verified'])->name('publicaciones.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/adopta/crear', [MascotaAdopcionController::class, 'create'])->name('mascotaAdopcion.create');
Route::post('/adopta/guardar', [MascotaAdopcionController::class, 'store'])->name('mascotas.store');
Route::get('/adopta', [MascotaAdopcionController::class, 'index'])->name('adopta.index');

Route::middleware('auth')->group(function () {
    Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
});

Route::post('/publicaciones/{publicacion}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/publicaciones/{publicacion}/reaccion/love', [ReaccionController::class, 'toggleLove'])->middleware('auth')->name('reacciones.love');



require __DIR__.'/auth.php';
