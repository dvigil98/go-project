<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Repositories\DepartamentoRepository;
use App\Http\Requests\DepartamentoFormRequest;

class DepartamentoController extends Controller
{
    private $departamentoRepository;

    public function __construct(DepartamentoRepository $departamentoRepository) {
        $this->departamentoRepository = $departamentoRepository;
        $this->middleware('auth');
    }

    public function index() {
        $departamentos = $this->departamentoRepository->getAll();
        return view('departamento/index', ['departamentos' => $departamentos]);
    }

    public function agregar() {
        return view('departamento/agregar', []);
    }

    public function guardar(DepartamentoFormRequest $request) {
        $request->validated();
        $departamento = new Departamento();
        $departamento->nombre = $request->input('nombre');
        if ( $this->departamentoRepository->save($departamento) ) 
            return redirect('/departamentos/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/departamentos/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $departamento = $this->departamentoRepository->getById($id);
        return view('departamento/editar', ['departamento' => $departamento]);
    }

    public function actualizar(DepartamentoFormRequest $request, $id) {
        $request->validated();
        $departamento = $this->departamentoRepository->getById($id);
        $departamento->nombre = $request->input('nombre');
        if ( $this->departamentoRepository->update($departamento) ) 
            return redirect('/departamentos')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/departamentos')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->departamentoRepository->delete($id) ) 
            return redirect('/departamentos')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/departamentos')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $departamento = $this->departamentoRepository->getDetails($id);
        return view('departamento/detalles', ['departamento' => $departamento]);
    }
}
