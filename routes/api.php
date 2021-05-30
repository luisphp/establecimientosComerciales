<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Listado de APIs
Route::get('/categorias', [App\Http\Controllers\APIController::class, 'categorias'])->name('categorias.list');
Route::get('/categoria/{categoria}', [App\Http\Controllers\APIController::class, 'categoria'])->name('categoria.list');
Route::get('/filtro/categoria/{categoria}', [App\Http\Controllers\APIController::class, 'estableCat'])->name('estableCat');

Route::get('/establecimiento/{establecimiento}', [App\Http\Controllers\APIController::class, 'show'])->name('establecimiento.show');

Route::get('/establecimientos', [App\Http\Controllers\APIController::class, 'index'])->name('establecimientos.index');