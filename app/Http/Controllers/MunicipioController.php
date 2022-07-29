<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Repositories\MunicipioRepository;
use App\Http\Requests\MunicipioFormRequest;

class MunicipioController extends Controller
{
    private $municipioRepository;

    public function __construct(MunicipioRepository $municipioRepository) {
        $this->municipioRepository = $municipioRepository;
        $this->middleware('auth');
    }

    public function index() {
        $municipios = $this->municipioRepository->getAll();
        return view('municipio/index', ['municipios' => $municipios]);
    }

    public function agregar() {
        $departamentos = $this->municipioRepository->getDepartamentos();
        return view('municipio/agregar', ['departamentos' => $departamentos]);
    }

    public function guardar(MunicipioFormRequest $request) {
        $request->validated();
        $municipio = new Municipio();
        $municipio->nombre = $request->input('nombre');
        $municipio->departamento_id = $request->input('departamento_id');
        if ( $this->municipioRepository->save($municipio) ) 
            return redirect('/municipios/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/municipios/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $municipio = $this->municipioRepository->getById($id);
        $departamentos = $this->municipioRepository->getDepartamentos();
        return view('municipio/editar', ['municipio' => $municipio, 'departamentos' => $departamentos]);
    }

    public function actualizar(MunicipioFormRequest $request, $id) {
        $request->validated();
        $municipio = $this->municipioRepository->getById($id);
        $municipio->nombre = $request->input('nombre');
        $municipio->departamento_id = $request->input('departamento_id');
        if ( $this->municipioRepository->update($municipio) ) 
            return redirect('/municipios')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/municipios')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->municipioRepository->delete($id) ) 
            return redirect('/municipios')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/municipios')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $municipio = $this->municipioRepository->getDetails($id);
        return view('municipio/detalles', ['municipio' => $municipio]);
    }
}
