<?php

use App\Http\Controllers\AvistamientoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\AmbientalistaController;
use App\Http\Controllers\CiudadanoController;
use Illuminate\Support\Facades\Route;
/* use App\Http\Controllers\Auth; */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('index');
}); */

Route::view('/', 'index')->name('apodIndex');

Auth::routes();

Route::resource('home',AvistamientoController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Rutas para Admin
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/InicioAdmin', [AdminController::class, 'inicio'])->name('admin');
        // Agrega más rutas para admin aquí
    });

    // Rutas para Especialista
    Route::prefix('especialista')->middleware(['role:especialista'])->group(function () {
        Route::get('/InicioEsp', [EspecialistaController::class, 'inicio'])->name('especialista');
        // Agrega más rutas para especialista aquí
    });

    // Rutas para Ambientalista
    Route::prefix('ambientalista')->middleware(['role:ambientalista'])->group(function () {
        Route::get('/InicioAmb', [AmbientalistaController::class, 'inicio'])->name('ambientalista');
        // Agrega más rutas para ambientalista aquí
    });

    // Rutas para Ciudadano
    Route::prefix('ciudadano')->middleware(['role:ciudadano'])->group(function () {
        Route::get('/InicioCiu', [CiudadanoController::class, 'inicio'])->name('ciudadano');
        // Agrega más rutas para ciudadano aquí
    });
});
