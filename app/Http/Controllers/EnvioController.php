<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Envio;
use App\Models\EnvioDetalle;
use App\Models\HistorialMovimiento;
use App\Repositories\EnvioRepository;
use Illuminate\Support\Facades\DB;

class EnvioController extends Controller
{
    private $envioRepository;

    public function __construct(EnvioRepository $envioRepository) {
        $this->envioRepository = $envioRepository;
        $this->middleware('auth');
    }

    public function index() {
        $envios = $this->envioRepository->getAll();
        return view('envio/index', ['envios' => $envios]);
    }

    public function agregar() {
        $conductores = $this->envioRepository->getConductores();
        $rutas = $this->envioRepository->getRutas();
        $paquetes = $this->envioRepository->getPaquetes();
        return view('envio/agregar', ['conductores' => $conductores, 'rutas' => $rutas, 'paquetes' => $paquetes]);
    }

    public function guardar(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'fecha_delivery' => 'required',
            'user_id' => 'required',
            'ruta_id' => 'required'
        ]);
        $envio = new Envio();
        $envio->nombre = $request->input('nombre');
        $envio->fecha_delivery = $request->input('fecha_delivery');
        $envio->user_id = $request->input('user_id');
        $envio->ruta_id = $request->input('ruta_id');
        if ( $this->envioRepository->saveMaestro($envio) ) {
            $envio_id = $envio->id;
            $inventarioId = $request->input('inventarioId');
            $solicitudId = $request->input('solicitudId');
            $i = 0;
            while ($i < count($inventarioId)) {
                $detalle = new EnvioDetalle();
                $detalle->envio_id = $envio_id;
                $detalle->inventario_id = $inventarioId[$i];
                $this->envioRepository->saveDetalle($detalle);
            
                $uptStatusInv = DB::table('inventarios')->where('id', $inventarioId[$i])->update(['estado' => 'No disponible']);
                $uptStatusSol = DB::table('solicitudes')->where('id', $solicitudId[$i])->update(['estado_id' => 3]);
                
                $hoy = getDate();
                $fecha_registro = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                
                $historial = new HistorialMovimiento();
                $historial->fecha = $fecha_registro;
                $historial->descripcion = 'El estado de la solicitud es: Enviado';
                $historial->estado_id = 3;
                $historial->solicitud_id = $solicitudId[$i];
                $historial->save();

                $i++;

                
            }
            return redirect('/envios/agregar')->with('msgType','success')->with('msg','Datos guardados');
        } else
            return redirect('/envios/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $envio = $this->envioRepository->getById($id);
        return view('envio/editar', ['envio' => $envio]);
    }

    public function actualizar(Request $request, $id) {
        $request->validated();
        $envio = $this->envioRepository->getById($id);
        $envio->nombre = $request->input('nombre');
        if ( $this->envioRepository->update($envio) ) 
            return redirect('/envios')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/envios')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->envioRepository->delete($id) ) 
            return redirect('/envios')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/envios')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $envio = $this->envioRepository->getEnvio($id);
        $detalles = $this->envioRepository->getDetalles($id);
        return view('envio/detalles', ['envio' => $envio, 'detalles' => $detalles]);
    }
}
