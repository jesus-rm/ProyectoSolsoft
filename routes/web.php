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
    Route::get('/estados', [EstadoController::class, 'index'])->name('dashboard.estados');
    Route::get('/municipios', [MunicipioController::class, 'index'])->name('dashboard.municipios');
});
