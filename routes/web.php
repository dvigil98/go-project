<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\DestinatarioController;
 
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

// rutas
Route::get('/rutas', [RutaController::class, 'index']);
Route::get('/rutas/agregar', [RutaController::class, 'agregar']);
Route::post('/rutas/guardar', [RutaController::class, 'guardar']);
Route::delete('/rutas/eliminar/{id}', [RutaController::class, 'eliminar']);
Route::get('/rutas/detalles/{id}', [RutaController::class, 'detalles']);
Route::get('/rutas/municipios/departamento/{departamento_id}', [RutaController::class, 'obtenerMunicipios']);
Route::put('/rutas/editar/detalle', [RutaController::class, 'editarDetalle']);
Route::delete('/rutas/eliminar/detalle/{id}', [RutaController::class, 'eliminarDetalle']);
Route::post('/rutas/agregar/municipio', [RutaController::class, 'agregarMunicipio']);

// clientes
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/agregar', [ClienteController::class, 'agregar']);
Route::post('/clientes/guardar', [ClienteController::class, 'guardar']);
Route::get('/clientes/editar/{id}', [ClienteController::class, 'editar']);
Route::put('/clientes/actualizar/{id}', [ClienteController::class, 'actualizar']);
Route::delete('/clientes/eliminar/{id}', [ClienteController::class, 'eliminar']);
Route::get('/clientes/detalles/{id}', [ClienteController::class, 'detalles']);

// empresas
Route::get('/empresas', [EmpresaController::class, 'index']);
Route::get('/empresas/agregar', [EmpresaController::class, 'agregar']);
Route::post('/empresas/guardar', [EmpresaController::class, 'guardar']);
Route::get('/empresas/editar/{id}', [EmpresaController::class, 'editar']);
Route::put('/empresas/actualizar/{id}', [EmpresaController::class, 'actualizar']);
Route::delete('/empresas/eliminar/{id}', [EmpresaController::class, 'eliminar']);
Route::get('/empresas/detalles/{id}', [EmpresaController::class, 'detalles']);

// sucursales
Route::get('/sucursales', [SucursalController::class, 'index']);
Route::get('/sucursales/agregar', [SucursalController::class, 'agregar']);
Route::post('/sucursales/guardar', [SucursalController::class, 'guardar']);
Route::get('/sucursales/editar/{id}', [SucursalController::class, 'editar']);
Route::put('/sucursales/actualizar/{id}', [SucursalController::class, 'actualizar']);
Route::delete('/sucursales/eliminar/{id}', [SucursalController::class, 'eliminar']);
Route::get('/sucursales/detalles/{id}', [SucursalController::class, 'detalles']);
Route::get('/sucursales/municipios/departamento/{departamento_id}', [SucursalController::class, 'obtenerMunicipios']);

// destinatarios
Route::get('/destinatarios', [DestinatarioController::class, 'index']);
Route::get('/destinatarios/agregar', [DestinatarioController::class, 'agregar']);
Route::post('/destinatarios/guardar', [DestinatarioController::class, 'guardar']);
Route::get('/destinatarios/editar/{id}', [DestinatarioController::class, 'editar']);
Route::put('/destinatarios/actualizar/{id}', [DestinatarioController::class, 'actualizar']);
Route::delete('/destinatarios/eliminar/{id}', [DestinatarioController::class, 'eliminar']);
Route::get('/destinatarios/detalles/{id}', [DestinatarioController::class, 'detalles']);

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

    $rol3 = new Rol();
    $rol3->nombre = 'Gerente de logistica';
    $rol3->descripcion = 'Rol para manejar todas las funcionalidades que corresponde a las solicitudes de envios y rutas';
    $rol3->save();

    $user = new User();
    $user->nombre = 'David Vigil';
    $user->email = 'david@gmail.com';
    $user->password = Hash::make('1234');
    $user->rol_id = 1;
    $user->activo = 1;
    $user->save();

    return redirect('/');
});
