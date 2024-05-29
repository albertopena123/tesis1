<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\GremioController;
use App\Http\Controllers\UsuariosRegistradosController;


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

Route::get('/', function () {
    return view('welcome
    ');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/usuarios', [DashboardController::class, 'usuarios'])->name('usuarios');
    Route::get('/operacion', [DashboardController::class, 'operacion'])->name('operacion');
    Route::get('/gremios', [DashboardController::class, 'gremios'])->name('gremios');
    Route::get('/carnets', [DashboardController::class, 'carnet'])->name('carnets');
    Route::post('/registro', [UsuariosRegistradosController::class, 'create'])->name('registro');

    Route::post('/store', [GremioController::class, 'store'])->name('store');
    Route::post('/operacion', [GremioController::class, 'operacion'])->name('operacion');
    Route::post('/carnets', [GremioController::class, 'carnet'])->name('carnet');
    Route::post('/updatecarnet', [GremioController::class, 'updatecarnet'])->name('updatecarnet');

    Route::get('/obtenerDatosSocio', [GremioController::class, 'obtenerDatosSocio'])->name('obtenerDatosSocio');
    Route::get('/verificardatos', [GremioController::class, 'verificarDatos'])->name('verificarDatos');



});
