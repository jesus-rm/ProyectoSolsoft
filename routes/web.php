<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MunicipioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Rutas definidas en vendor/laravel/ui/src/AuthRouteMethods */
Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.inicio');
    Route::get('/personas', [PersonaController::class, 'index'])->name('dashboard.personas');
    Route::post('personas/crear', [PersonaController::class, 'store'])->name("personas.store");
    Route::post('personas/mostrar', [PersonaController::class, 'show'])->name("personas.show");
    Route::post("personas/actualizar/{id}",[PersonaController::class, 'update']);
    Route::post('personas/eliminar/{id}', [PersonaController::class, 'destroy']);

    Route::get('/estados', [EstadoController::class, 'index'])->name('dashboard.estados');
    Route::post('estados/crear', [EstadoController::class, 'store'])->name("estados.store");
    Route::post('estados/mostrar', [EstadoController::class, 'show'])->name("estados.show");
    Route::post("estados/actualizar/{id}",[EstadoController::class, 'update']);
    Route::post('estados/eliminar/{id}', [EstadoController::class, 'destroy']);
    
    Route::get('/municipios', [MunicipioController::class, 'index'])->name('dashboard.municipios');
    Route::post('municipios/crear', [MunicipioController::class, 'store'])->name("municipios.store");
    Route::post('municipios/mostrar', [MunicipioController::class, 'show'])->name("municipios.show");
    Route::post("municipios/actualizar/{id}",[MunicipioController::class, 'update']);
    Route::post('municipios/eliminar/{id}', [MunicipioController::class, 'destroy']);
});
