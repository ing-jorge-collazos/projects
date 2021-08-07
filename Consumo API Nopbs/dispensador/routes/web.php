<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::group(['prefix' => 'api'], function () {
        Route::get('/direccionamiento', [App\Http\Controllers\SuministrosApi\DireccionamientoController::class, 'index'])->name('direccionamiento');
        Route::get('/direccionamiento/data', [App\Http\Controllers\SuministrosApi\DireccionamientoController::class, 'getData'])->name('direccionamiento.data');
        Route::get('/entrega', [App\Http\Controllers\SuministrosApi\EntregaController::class, 'index'])->name('entrega');
        Route::get('/entrega/data', [App\Http\Controllers\SuministrosApi\EntregaController::class, 'getData'])->name('entrega.data');
        Route::get('/programacion', [App\Http\Controllers\SuministrosApi\ProgramacionController::class, 'index'])->name('programacion');
        Route::get('/programacion/data', [App\Http\Controllers\SuministrosApi\ProgramacionController::class, 'getData'])->name('programacion.data');
        Route::get('/reporte-entrega', [App\Http\Controllers\SuministrosApi\ReporteEntregaController::class, 'index'])->name('reporte-entrega');
        Route::get('/reporte-entrega/data', [App\Http\Controllers\SuministrosApi\ReporteEntregaController::class, 'getData'])->name('reporte-entrega.data');
    });
    Route::group(['prefix' => 'ui'], function () {
        Route::get('/entrega/form', [App\Http\Controllers\SuministrosApi\EntregaController::class, 'indexForm'])->name('entrega-form');
        Route::post('/entrega/form/{array}', [App\Http\Controllers\SuministrosApi\EntregaController::class, 'setFormData'])->name('entrega-form-data');
        Route::put('/entrega/reportar', [App\Http\Controllers\SuministrosApi\EntregaController::class, 'reportarEntrega'])->name('reportar-entrega');
        Route::put('/entrega/anular', [App\Http\Controllers\SuministrosApi\EntregaController::class, 'anularEntrega'])->name('anular-entrega');

        Route::get('/programacion/form', [App\Http\Controllers\SuministrosApi\ProgramacionController::class, 'indexForm'])->name('programacion.form');
        Route::post('/programacion/form/data', [App\Http\Controllers\SuministrosApi\ProgramacionController::class, 'setFormData'])->name('programacion-form-data');
        Route::put('/programacion/reportar', [App\Http\Controllers\SuministrosApi\ProgramacionController::class, 'reportarProgramacion'])->name('reportar-programacion');
        Route::put('/programacion/anular', [App\Http\Controllers\SuministrosApi\ProgramacionController::class, 'anularProgramacion'])->name('anular-programacion');
    });
});
Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

//Route::get('/', [App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])->name('login');
