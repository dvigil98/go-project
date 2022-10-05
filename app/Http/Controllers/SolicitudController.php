<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Inventario;
use App\Models\HistorialMovimiento;
use App\Repositories\SolicitudRepository;
use App\Repositories\InventarioRepository;
use App\Http\Requests\SolicitudFormRequest;


class SolicitudController extends Controller
{
    private $solicitudRepository;
    private $inventarioRepository;

    public function __construct(SolicitudRepository $solicitudRepository, InventarioRepository $inventarioRepository) {
        $this->solicitudRepository = $solicitudRepository;
        $this->inventarioReposotiry = $inventarioRepository;
        $this->middleware('auth');
    }

    public function index() {
        $solicitudes = $this->solicitudRepository->getAll();
        return view('solicitud/index', ['solicitudes' => $solicitudes]);
    }

    public function agregar() {
        $clientes = $this->solicitudRepository->getClientes();
        $rutas = $this->solicitudRepository->getRutas();
        return view('solicitud/agregar', ['clientes' => $clientes, 'rutas' => $rutas]);
    }

    public function guardar(SolicitudFormRequest $request) {
        $request->validated();
        $solicitud = new Solicitud();
        $ultimoCodigo = Solicitud::max('num_codigo');
        if ( $ultimoCodigo == null ) {
            $b_codigo = 1001;
        } else {
            $b_codigo = $ultimoCodigo + 1;
        }
        
        $prefijo_codigo = 'ENV';
        $num_codigo = $b_codigo;
        $sufijo_codigo = 'SV';

        $solicitud->prefijo_codigo = $prefijo_codigo;
        $solicitud->num_codigo = $num_codigo;
        $solicitud->sufijo_codigo = $sufijo_codigo;
        $solicitud->descripcion = $request->input('descripcion');
        $solicitud->observacion = $request->input('observacion'); 
        $solicitud->costo = $request->input('costo');
        $solicitud->estado_id = 1;
        $solicitud->sucursal_id = $request->input('sucursal_id');
        $solicitud->direccion_destinatario_id = $request->input('direccion_destinatario_id');
        if ( $this->solicitudRepository->save($solicitud) ) {

            $hoy = getDate();
            $fecha_registro = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];

            $historial = new HistorialMovimiento();
            $historial->fecha = $fecha_registro;
            $historial->descripcion = 'El estado de la solicitud es: Notifcado';
            $historial->estado_id = 1;
            $historial->solicitud_id = $solicitud->id; 
            
            $this->solicitudRepository->guardarHistorial($historial);

            return redirect('/solicitudes/agregar')->with('msgType','success')->with('msg','Datos guardados');
        } else {
            return redirect('/solicitudes/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
        }
    }

    public function editar($id) {
        $solicitud = $this->solicitudRepository->getById($id);
        return view('solicitud/editar', ['solicitud' => $solicitud]);
    }

    public function actualizar(SolicitudFormRequest $request, $id) {
        $request->validated();
        $solicitud = $this->solicitudRepository->getById($id);
        $solicitud->nombre = $request->input('nombre');
        if ( $this->solicitudRepository->update($solicitud) ) 
            return redirect('/solicitudes')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/solicitudes')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->solicitudRepository->delete($id) ) 
            return redirect('/solicitudes')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/solicitudes')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $solicitud = $this->solicitudRepository->getDetails($id);
        $estados = $this->solicitudRepository->obtenerEstados();
        return view('solicitud/detalles', ['solicitud' => $solicitud, 'estados' => $estados]);
    }


    public function cambiarEstado($solicitud_id, $id) {

        $hoy = getDate();
        $fecha_registro = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
        
        $historial = new HistorialMovimiento();

        $solicitudId = $solicitud_id;
        $estado_id = $id;
        $descripcion = '';

        switch ($estado_id) {
            case 1:
                $descripcion = 'El estado de la solicitud es: Notifcado';
                break;
            case 2:
                $descripcion = 'El estado de la solicitud es: Recolectado';
                break;
            case 3:
                $descripcion = 'El estado de la solicitud es: Enviado';
                break;
            case 4:
                $descripcion = 'El estado de la solicitud es: Entregado';
                break;
            case 5:
                    $descripcion = 'El estado de la solicitud es: Devuelto a bodega';
                    break;
        }

        $historial->fecha = $fecha_registro;
        $historial->descripcion = $descripcion;
        $historial->estado_id = $estado_id;
        $historial->solicitud_id = $solicitudId;

        Solicitud::find($solicitudId)->update(['estado_id' => $estado_id]);

        $this->solicitudRepository->guardarHistorial($historial);

        if ( $estado_id == 2 ) {

            $inventario = new Inventario();
            $inventario->solicitud_id = $solicitud_id;
            $inventario->bodega_id = 1;
            $inventario->estado = 'Disponible';
            $inventario->save();

        }

        if ( $estado_id == 4 ) {

            $inventario = Inventario::where('solicitud_id', $solicitud_id)->first();
            $inventario->estado = 'No disponible';
            $inventario->save();

        }

        if ( $estado_id == 5 ) {
            $inventario = Inventario::where('solicitud_id', $solicitud_id)->first();
            $inventario->estado = 'Disponible';
            $inventario->save();
        }

        return redirect('/solicitudes/detalles/'.$solicitudId)->with('msgType','success')->with('msg','Datos guardados');
    }

    // 

    public function obtenerEmpresas($cliente_id) {
        $empresas = $this->solicitudRepository->getEmpresas($cliente_id);
        return $empresas;
    }

    public function obtenerSucursales($empresa_id) {
        $sucursales = $this->solicitudRepository->getSucursales($empresa_id);
        return $sucursales;
    }

    public function obtenerDestinatarios($cliente_id) {
        $destinatarios = $this->solicitudRepository->getDestinatarios($cliente_id);
        return $destinatarios;
    }

    public function obtenerDirecciones($destinatario_id) {
        $direcciones = $this->solicitudRepository->getDireccionesDestinatario($destinatario_id);
        return $direcciones;
    }

    public function obtenerDireccion($direccion_id) {
        $direccion = $this->solicitudRepository->getDireccion($direccion_id);
        return $direccion;
    }

    public function obtenerDepartamentos($ruta_id) {
        $departamentos = $this->solicitudRepository->getDepartamentos($ruta_id);
        return $departamentos;
    }

    public function obtenerMunicipios($departamento_id) {
        $municipios = $this->solicitudRepository->getMunicipios($departamento_id);
        return $municipios;
    }

    public function obtenerHistorial($solicitud_id) {
        $historial = $this->solicitudRepository->obtenerHistorialPorSolicitud($solicitud_id);
        return $historial;
    }
    
    public function trackPackage() {
        return view('solicitud/track');
    }

}
