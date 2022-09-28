<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use App\Repositories\BodegaRepository;
use App\Http\Requests\BodegaFormRequest;

class BodegaController extends Controller
{
    private $bodegaRepository;

    public function __construct(BodegaRepository $bodegaRepository) {
        $this->bodegaRepository = $bodegaRepository;
        $this->middleware('auth');
    }

    public function index() {
        $bodegas = $this->bodegaRepository->getAll();
        return view('bodega/index', ['bodegas' => $bodegas]);
    }

    public function agregar() {
        $departamentos = $this->bodegaRepository->getDepartamentos();
        return view('bodega/agregar', ['departamentos' => $departamentos]);
    }

    public function guardar(BodegaFormRequest $request) {
        $request->validated();
        $bodega = new Bodega();
        $bodega->nombre = $request->input('nombre');
        $bodega->descripcion = $request->input('descripcion');
        $bodega->direccion = $request->input('direccion');
        $bodega->municipio_id = $request->input('municipio_id');
        if ( $this->bodegaRepository->save($bodega) ) 
            return redirect('/bodegas/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/bodegas/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $bodega = $this->bodegaRepository->getById($id);
        $departamentos = $this->bodegaRepository->getDepartamentos();
        return view('bodega/editar', ['bodega' => $bodega, 'departamentos' => $departamentos]);
    }

    public function actualizar(BodegaFormRequest $request, $id) {
        $request->validated();
        $bodega = $this->bodegaRepository->getById($id);
        $bodega->nombre = $request->input('nombre');
        $bodega->descripcion = $request->input('descripcion');
        $bodega->direccion = $request->input('direccion');
        $bodega->municipio_id = $request->input('municipio_id');
        if ( $this->bodegaRepository->update($bodega) ) 
            return redirect('/bodegas')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/bodegas')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->bodegaRepository->delete($id) ) 
            return redirect('/bodegas')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/bodegas')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $bodega = $this->bodegaRepository->getDetails($id);
        return view('bodega/detalles', ['bodega' => $bodega]);
    }
}
