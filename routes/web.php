<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
 
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

// ruta inicial
Route::get('/', function() {
    return redirect('/login');
});

// login
Route::match(['get','post'], '/login', [LoginController::class, 'login'])->name('login');

// logout
Route::get('/logout', [LoginController::class, 'logout']);

// dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard']);

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
