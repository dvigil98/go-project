<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Repositories\EmpresaRepository;
use App\Http\Requests\EmpresaFormRequest;

class EmpresaController extends Controller
{
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepository) {
        $this->empresaRepository = $empresaRepository;
        $this->middleware('auth');
    }

    public function index() {
        $empresas = $this->empresaRepository->getAll();
        return view('empresa/index', ['empresas' => $empresas]);
    }

    public function agregar() {
        $clientes = $this->empresaRepository->getClientes();
        return view('empresa/agregar', ['clientes' => $clientes]);
    }

    public function guardar(EmpresaFormRequest $request) {
        $request->validated();
        $empresa = new Empresa();
        $empresa->razon_social = $request->input('razon_social');
        $empresa->activo = 1;
        $empresa->cliente_id = $request->input('cliente_id');
        if ( $this->empresaRepository->save($empresa) ) 
            return redirect('/empresas/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/empresas/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $empresa = $this->empresaRepository->getById($id);
        $clientes = $this->empresaRepository->getClientes();
        return view('empresa/editar', ['empresa' => $empresa, 'clientes' => $clientes]);
    }

    public function actualizar(Request $request, $id) {
        $request->validate([
            'razon_social' => 'required',
            'activo' => 'required',
            'cliente_id' => 'required'
        ]);
        $empresa = $this->empresaRepository->getById($id);
        $empresa->razon_social = $request->input('razon_social');
        $empresa->activo = $request->input('activo');
        $empresa->cliente_id = $request->input('cliente_id');
        if ( $this->empresaRepository->update($empresa) ) 
            return redirect('/empresas')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/empresas')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->empresaRepository->delete($id) ) 
            return redirect('/empresas')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/empresas')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $empresa = $this->empresaRepository->getDetails($id);
        return view('empresa/detalles', ['empresa' => $empresa]);
    }

}
