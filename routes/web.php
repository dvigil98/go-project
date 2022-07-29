<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartamentoController;
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

// departamentos
Route::get('/departamentos', [DepartamentoController::class, 'index']);
Route::get('/departamentos/agregar', [DepartamentoController::class, 'agregar']);
Route::post('/departamentos/guardar', [DepartamentoController::class, 'guardar']);
Route::get('/departamentos/editar/{id}', [DepartamentoController::class, 'editar']);
Route::put('/departamentos/actualizar/{id}', [DepartamentoController::class, 'actualizar']);
Route::delete('/departamentos/eliminar/{id}', [DepartamentoController::class, 'eliminar']);
Route::get('/departamentos/detalles/{id}', [DepartamentoController::class, 'detalles']);

// municipios
Route::get('/municipios', [MunicipioController::class, 'index']);
Route::get('/municipios/agregar', [MunicipioController::class, 'agregar']);
Route::post('/municipios/guardar', [MunicipioController::class, 'guardar']);
Route::get('/municipios/editar/{id}', [MunicipioController::class, 'editar']);
Route::put('/municipios/actualizar/{id}', [MunicipioController::class, 'actualizar']);
Route::delete('/municipios/eliminar/{id}', [MunicipioController::class, 'eliminar']);
Route::get('/municipios/detalles/{id}', [MunicipioController::class, 'detalles']);

// Configuracion inicial

use App\Models\Rol;
use App\Models\User;

Route::get('/crear-usuario', function() {
    $rol1 = new Rol();
    $rol1->nombre = 'Administrador';
    $rol1->descripcion = 'Rol para manejar todas las funcionalidades de la aplicacion';
    $rol1->save();

    $rol2 = new Rol();
    $rol2->nombre = 'Conductor';
    $rol2->descripcion = 'Rol para manejar todas las funcionalidades que corresponde a los conductores';
    $rol2->save();

    $user = new User();
    $user->nombre = 'David Vigil';
    $user->email = 'david@gmail.com';
    $user->password = Hash::make('1234');
    $user->rol_id = 1;
    $user->activo = 1;
    $user->save();

    return redirect('/');
});

