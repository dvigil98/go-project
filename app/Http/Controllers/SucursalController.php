<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Repositories\SucursalRepository;

use App\Http\Requests\SucursalFormRequest;

class SucursalController extends Controller
{
    private $sucursalRepository;
    

    public function __construct(SucursalRepository $sucursalRepository) {
        $this->sucursalRepository = $sucursalRepository;
        
        $this->middleware('auth');
    }

    public function index() {
        $sucursales = $this->sucursalRepository->getAll();
        return view('sucursal/index', ['sucursales' => $sucursales]);
    }

    public function agregar() {
        $departamentos = $this->sucursalRepository->getDepartamentos();
        $empresas = $this->sucursalRepository->getEmpresas();
        return view('sucursal/agregar', ['departamentos' => $departamentos, 'empresas' => $empresas]);
    }

    public function guardar(SucursalFormRequest $request) {
        $request->validated();
        $sucursal = new Sucursal();
        $sucursal->nombre = $request->input('nombre');
        $sucursal->telefono = $request->input('telefono');
        $sucursal->direccion = $request->input('direccion');
        $sucursal->activo = 1;
        $sucursal->municipio_id = $request->input('municipio_id');
        $sucursal->empresa_id = $request->input('empresa_id');
        if ( $this->sucursalRepository->save($sucursal) ) 
            return redirect('/sucursales/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/sucursales/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $sucursal = $this->sucursalRepository->getById($id);
        $departamentos = $this->sucursalRepository->getDepartamentos();
        $empresas = $this->sucursalRepository->getEmpresas();
        return view('sucursal/editar', ['sucursal' => $sucursal, 'departamentos' => $departamentos, 'empresas' => $empresas]);
    }

    public function actualizar(Request $request, $id) {
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'activo' => 'required',
            'departamento_id' => 'required',
            'municipio_id' => 'required',
            'empresa_id' => 'required'
        ]);
        $sucursal = $this->sucursalRepository->getById($id);
        $sucursal->nombre = $request->input('nombre');
        $sucursal->telefono = $request->input('telefono');
        $sucursal->direccion = $request->input('direccion');
        $sucursal->activo = $request->input('activo');
        $sucursal->municipio_id = $request->input('municipio_id');
        $sucursal->empresa_id = $request->input('empresa_id');
        if ( $this->sucursalRepository->update($sucursal) ) 
            return redirect('/sucursales')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/sucursales')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->sucursalRepository->delete($id) ) 
            return redirect('/sucursales')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/sucursales')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $sucursal = $this->sucursalRepository->getDetails($id);
        return view('sucursal/detalles', ['sucursal' => $sucursal]);
    }

    // External

    public function obtenerMunicipios($departamento_id) {
        $municipios = $this->sucursalRepository->getMunicipiosPorDepartamento($departamento_id);
        return $municipios;
    }
    
}
