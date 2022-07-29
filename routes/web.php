<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
 
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
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login/login');
});

Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
});


// roles
Route::get('/roles', [RolController::class, 'index']);

// users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/agregar', [UserController::class, 'agregar']);
Route::post('/users/guardar', [UserController::class, 'guardar']);
Route::get('/users/editar/{id}', [UserController::class, 'editar']);
Route::put('/users/actualizar/{id}', [UserController::class, 'actualizar']);
Route::delete('/users/eliminar/{id}', [UserController::class, 'eliminar']);
Route::get('/users/detalles/{id}', [UserController::class, 'detalles']);
