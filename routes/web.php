<?php

use Illuminate\Support\Facades\Route;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Estado;
use App\Models\Municipio;

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

Route::get('/', function () {
    /* $estados = (new FastExcel)->import('C:\Users\jesus\Documents\BaseDatos\estadosBD.xlsx', function ($line) {
        return Estado::create([
            'claveEstado' => $line['Clave'],
            'codigoEstado' => $line['ISO'],
            'nombreEstado' => $line['Estado']
        ]);
    }); */
    /* $municipios = (new FastExcel)->import('C:\Users\jesus\Documents\BaseDatos\Estado1.xlsx', function ($line) {
        return Municipio::create([
            'claveMunicipio' => $line['Clave'],
            'nombreMunicipio' => $line['Municipio'],
            'estado_id' => $line['id']
        ]);
    }); */
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
