<?php

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

Route::get('/',  [App\Http\Controllers\InicioController::class, '__invoke'])->name('inicio');


Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified']], function () {
    //Establecimiento
    Route::get('/establecimiento/create', [App\Http\Controllers\EstablecimientoController::class, 'create'])->name('establecimiento.create');

    Route::post('/establecimiento', [App\Http\Controllers\EstablecimientoController::class, 'store'])->name('establecimiento.store');

    Route::get('/establecimiento/edit', [App\Http\Controllers\EstablecimientoController::class, 'edit'])->name('establecimiento.edit');

    //Imagenes
    Route::post('/imagenes/store', [App\Http\Controllers\ImagenController::class, 'store'])->name('imagenes.store');
    Route::post('/imagenes/destroy', [App\Http\Controllers\ImagenController::class, 'destroy'])->name('imagenes.destroy');
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
