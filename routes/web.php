<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReaccionController;
use App\Http\Controllers\ComentarioController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/barrap', function () {
    return view('barrap');
})->middleware(['auth', 'verified'])->name('barrap');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
});

Route::post('/publicaciones/{publicacion}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/publicaciones/{publicacion}/reaccion/love', [ReaccionController::class, 'toggleLove'])->middleware('auth')->name('reacciones.love');




require __DIR__.'/auth.php';
