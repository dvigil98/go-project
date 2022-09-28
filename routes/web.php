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
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\InventarioController;

use App\Http\Controllers\TrackController;
 
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

// direcciones
Route::post('/direcciones/guardar', [DestinatarioController::class, 'guardarDireccion']);
Route::get('/direcciones/obtener/{id}', [DestinatarioController::class, 'obtenerDireccion']);
Route::put('/direcciones/actualizar', [DestinatarioController::class, 'actualizarDireccion']);
Route::delete('/direcciones/eliminar/{id}', [DestinatarioController::class, 'eliminarDireccion']);

// solicitudes
Route::get('/solicitudes', [SolicitudController::class, 'index']);
Route::get('/solicitudes/agregar', [SolicitudController::class, 'agregar']);
Route::post('/solicitudes/guardar', [SolicitudController::class, 'guardar']);
Route::get('/solicitudes/editar/{id}', [SolicitudController::class, 'editar']);
Route::put('/solicitudes/actualizar/{id}', [SolicitudController::class, 'actualizar']);
Route::delete('/solicitudes/eliminar/{id}', [SolicitudController::class, 'eliminar']);
Route::get('/solicitudes/detalles/{id}', [SolicitudController::class, 'detalles']);
Route::get('/solicitudes/obtener-empresas/{cliente_id}', [SolicitudController::class, 'obtenerEmpresas']);
Route::get('/solicitudes/obtener-sucursales/{empresa_id}', [SolicitudController::class, 'obtenerSucursales']);
Route::get('/solicitudes/obtener-destinatarios/{cliente_id}', [SolicitudController::class, 'obtenerDestinatarios']);
Route::get('/solicitudes/obtener-direcciones/{destinatario_id}', [SolicitudController::class, 'obtenerDirecciones']);
Route::get('/solicitudes/obtener-direccion/{direccion_id}', [SolicitudController::class, 'obtenerDireccion']);
Route::get('/solicitudes/obtener-departamentos/{ruta_id}', [SolicitudController::class, 'obtenerDepartamentos']);
Route::get('/solicitudes/obtener-municipios/{departamento_id}', [SolicitudController::class, 'obtenerMunicipios']);
Route::get('/solicitudes/obtener-historial/{solicitud_id}', [SolicitudController::class, 'obtenerHistorial']);
Route::get('/solicitudes/cambiar-estado/{solicitud_id}/{id}', [SolicitudController::class, 'cambiarEstado']);

// bodegas
Route::get('/bodegas', [BodegaController::class, 'index']);
Route::get('/bodegas/agregar', [BodegaController::class, 'agregar']);
Route::post('/bodegas/guardar', [BodegaController::class, 'guardar']);
Route::get('/bodegas/editar/{id}', [BodegaController::class, 'editar']);
Route::put('/bodegas/actualizar/{id}', [BodegaController::class, 'actualizar']);
Route::delete('/bodegas/eliminar/{id}', [BodegaController::class, 'eliminar']);
Route::get('/bodegas/detalles/{id}', [BodegaController::class, 'detalles']);

// inventarios
Route::get('/inventarios', [InventarioController::class, 'index']);
Route::get('/inventarios/agregar', [InventarioController::class, 'agregar']);
Route::post('/inventarios/guardar', [InventarioController::class, 'guardar']);
Route::get('/inventarios/editar/{id}', [InventarioController::class, 'editar']);
Route::put('/inventarios/actualizar/{id}', [InventarioController::class, 'actualizar']);
Route::delete('/inventarios/eliminar/{id}', [InventarioController::class, 'eliminar']);
Route::get('/inventarios/detalles/{id}', [InventarioController::class, 'detalles']);

// track
Route::get('/track-package', [TrackController::class, 'trackView']);
Route::get('/obtener-historial/{codigo}', [TrackController::class, 'obtenerHistorialPorCodigo']);
Route::get('/obtener-solicitud/{codigo}', [TrackController::class, 'obtenerSolicitudPorCodigo']);

// Configuracion inicial

use App\Models\Rol;
use App\Models\User;
use App\Models\Estado;

Route::get('/crear-usuario', function() {

    // Estados de solicitudes
    $estado1 = new Estado();
    $estado1->nombre = 'Notificado';
    $estado1->descripcion = 'El estado de la solicitud de envio esta: Notificado';
    $estado1->save();

    $estado2 = new Estado();
    $estado2->nombre = 'Recolectado';
    $estado2->descripcion = 'El estado de la solicitud de envio esta: Recolectado';
    $estado2->save();

    $estado3 = new Estado();
    $estado3->nombre = 'Enviado';
    $estado3->descripcion = 'El estado de la solicitud de envio esta: Enviado';
    $estado3->save();

    $estado4 = new Estado();
    $estado4->nombre = 'Entregado';
    $estado4->descripcion = 'El estado de la solicitud de envio esta: Entregado';
    $estado4->save();

    // Roles
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

    // Usuarios
    $user = new User();
    $user->nombre = 'David Vigil';
    $user->email = 'david@gmail.com';
    $user->password = Hash::make('1234');
    $user->rol_id = 1;
    $user->activo = 1;
    $user->save();

    return redirect('/');

});
