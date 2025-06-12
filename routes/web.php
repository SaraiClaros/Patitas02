<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\MascotaAdopcionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/adopta/crear', [MascotaAdopcionController::class, 'create'])->name('mascotaAdopcion.create');
Route::post('/adopta/guardar', [MascotaAdopcionController::class, 'store'])->name('mascotas.store');
Route::get('/adopta', [MascotaAdopcionController::class, 'index'])->name('adopta.index');




Route::get('/seleccionar-tipo', [TipoUsuarioController::class, 'show'])->name('seleccionar.tipo');
Route::post('/seleccionar-tipo', [TipoUsuarioController::class, 'store'])->name('seleccionar.tipo.guardar');


require __DIR__.'/auth.php';
