<?php

use App\Http\Controllers\AvistamientoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\AmbientalistaController;
use App\Http\Controllers\CiudadanoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controlpublicaciones;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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

/* Route::view('/', 'index')->name('apodIndex'); */

Auth::routes();

Route::resource('home',AvistamientoController::class);

Route::get('/home', [controlpublicaciones::class, 'index'])->name('home');

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

// Rutas para el controlador de publicaciones
Route::post('/guardarpublicacion', [controlpublicaciones::class, 'guardarp'])->name('guardarpublicacion');

Route::post('/editarpubli/{id}', [controlPublicaciones::class, 'editarpublicacion'])->name('publicacion.update');

Route::post('/editarelimi/{id}', [controlPublicaciones::class, 'eliminarpublicacion'])->name('publicacion.delete');

/* Route::get('/', [controlpublicaciones::class,'index'])->name('home'); */

Route::view('/public', 'publicaciones')->name('publicaciones');
Route::view('/avistamientos', '/avistamientos/avisesp')->name('avistamientosesp');
Route::view('/avistamientos', '/avistamientos/avisamb')->name('avistamientosamb');
Route::view('/avistamientos', '/avistamientos/avisadmin')->name('avistamientosadmin');
Route::view('/avistamientos', '/avistamientos/avisciudadano')->name('avistamientosciud');
Route::view('/regavist', 'regisavis')->name('registroavis');
Route::view('/publicesp', 'publicacionesesp')->name('publicacionesesp');
Route::view('/regavistesp', 'regisavisesp')->name('registroavisesp');
Route::view('/regavistciu', 'regisavisciu')->name('registroavisciu');

Route::get('/inicio/inicioesp', [controlpublicaciones::class, 'index'])->name('esp2');
Route::get('/inicio/inicioamb', [controlpublicaciones::class, 'index'])->name('amb2');
Route::get('/inicio/inicioadmin', [controlpublicaciones::class, 'index'])->name('adm2');
Route::get('/inicio/iniciociudadano', [controlpublicaciones::class, 'index'])->name('ciu2');
Route::get('/', [controlpublicaciones::class, 'index'])->name('index');

Route::post('/guardaravistamiento', [AvistamientoController::class, 'guardara'])->name('guardaravis');

Route::post('/editaravist/{id}', [AvistamientoController::class, 'editarAvistamiento'])->name('avistamiento.update');

Route::post('/eliminaravis/{id}', [AvistamientoController::class, 'eliminarAvistamiento'])->name('avistamiento.delete');

Route::get('/avistamientos/avisesp', [AvistamientoController::class, 'index'])->name('aesp2');
Route::get('/avistamientos/avisamb', [AvistamientoController::class, 'index'])->name('aamb2');
Route::get('/avistamientos/avisadmin', [AvistamientoController::class, 'index'])->name('aadm2');
Route::get('/avistamientos/avisciudadano', [AvistamientoController::class, 'index'])->name('aciu2');

Route::get('/users', [UserController::class, 'index'])->name('consultas');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::delete('/avistamientos/{id}', [AvistamientoController::class, 'destroy'])->name('avistamientos.destroy');



Route::post('/perfil/update', [ProfileController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/{id}', [ProfileController::class, 'destroy'])->name('perfil.destroy');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile2', [CiudadanoController::class, 'show'])->name('profile2.show');
Route::get('/profile3', [EspecialistaController::class, 'show'])->name('profile3.show');