<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
use App\Models\RutaDetalle;
use App\Repositories\RutaRepository;
use App\Http\Requests\RutaFormRequest;

class RutaController extends Controller
{
    private $rutaRepository;

    public function __construct(RutaRepository $rutaRepository) {
        $this->rutaRepository = $rutaRepository;
        $this->middleware('auth');
    }

    public function index() {
        $rutas = $this->rutaRepository->getAll();
        return view('ruta/index', ['rutas' => $rutas]);
    }

    public function agregar() {
        $departamentos = $this->rutaRepository->getDepartamentos();
        return view('ruta/agregar', ['departamentos' => $departamentos]);
    }

    public function guardar(RutaFormRequest $request) {
        $request->validated();
        $ruta = new Ruta();
        $ruta->nombre = $request->input('nombre');
        $ruta->descripcion = $request->input('descripcion');
        if ( $this->rutaRepository->save($ruta) ) {
            $ruta_id = $ruta->id;
            $idMunicipio = $request->input('idMunicipio');
            $costo = $request->input('costo');
            $i = 0;
            while ($i < count($idMunicipio)) {
                $rutaDetalle = new RutaDetalle();
                $rutaDetalle->ruta_id = $ruta_id;
                $rutaDetalle->municipio_id = $idMunicipio[$i];
                $rutaDetalle->costo = $costo[$i];
                $this->rutaRepository->saveDetails($rutaDetalle);
                $i++;
            }
            return redirect('/rutas/agregar')->with('msgType','success')->with('msg','Datos guardados');
        } else {
            return redirect('/rutas/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
        }
    }

    public function eliminar($id) {
        if ( $this->rutaRepository->delete($id) )
            return redirect('/rutas')->with('msgType','success')->with('msg','Datos eliminados');
        else 
            return redirect('/rutas')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $ruta = $this->rutaRepository->getDetails($id);
        $rutasDetalles = $this->rutaRepository->getRutasDetalles($id);
        $departamentos = $this->rutaRepository->getDepartamentos();
        return view('ruta/detalles', ['ruta' => $ruta, 'detalles' => $rutasDetalles, 'departamentos' => $departamentos]);
    }

    public function eliminarDetalle(Request $request, $id) {
        $ruta_id = $request->input('ruta_id');
        if ( $this->rutaRepository->deleteDetail($id) )
            return redirect('/rutas/detalles/'.$ruta_id)->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/rutas/detalles/'.$ruta_id)->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function editarDetalle(Request $request) {
        $ruta_id = $request->input('ruta_id');
        $detalle_id = $request->input('detalle_id');
        $costo = $request->input('costo');
        $rutaDetalle = $this->rutaRepository->getDetailById($detalle_id);
        $rutaDetalle->costo = $costo;
        if ( $this->rutaRepository->updateDetail($rutaDetalle) )
            return redirect('/rutas/detalles/'.$ruta_id)->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/rutas/detalles/'.$ruta_id)->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function agregarMunicipio(Request $request) {
        $request->validate([
            'departamento_id' => 'required',
            'municipio_id' => 'required'
        ]);
        $rutaDetalle = new RutaDetalle();
        $ruta_id = $request->input('ruta_id');
        $rutaDetalle->ruta_id = $request->input('ruta_id');
        $rutaDetalle->municipio_id = $request->input('municipio_id');
        $rutaDetalle->costo = $request->input('costo');
        if ( $this->rutaRepository->saveDetails($rutaDetalle) ) 
            return redirect('/rutas/detalles/'.$ruta_id)->with('msgType','success')->with('msg','Datos guardados');
        else
        return redirect('/rutas/detalles/'.$ruta_id)->with('msgType','danger')->with('msg','Datos no guardados');
    }

    // External

    public function obtenerMunicipios($departamento_id) {
        $municipios = $this->rutaRepository->getMunicipiosPorDepartamento($departamento_id);
        return $municipios;
    }
}
