<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Repositories\InventarioRepository;

class InventarioController extends Controller
{
    private $inventarioRepository;

    public function __construct(InventarioRepository $inventarioRepository) {
        $this->inventarioRepository = $inventarioRepository;
        $this->middleware('auth');
    }

    public function index() {
        $inventarios = $this->inventarioRepository->getAll();
        return view('inventario/index', ['inventarios' => $inventarios]);
    }

    public function agregar() {
        return view('inventario/agregar', []);
    }

    public function guardar(Request $request) {
    }

    public function editar($id) {
        $inventario = $this->inventarioRepository->getById($id);
        $bodegas = $this->inventarioRepository->getBodegas();
        return view('inventario/editar', ['inventario' => $inventario, 'bodegas' => $bodegas]);
    }

    public function actualizar(Request $request, $id) {
        $request->validate([
            'bodega_id' => 'required'
        ]);
        $inventario = $this->inventarioRepository->getById($id);
        $inventario->bodega_id = $request->input('bodega_id');
        if ( $this->inventarioRepository->update($inventario) ) 
            return redirect('/inventarios')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/inventarios')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->inventarioRepository->delete($id) ) 
            return redirect('/inventarios')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/inventarios')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $inventario = $this->inventarioRepository->getDetails($id);
        return view('inventario/detalles', ['inventario' => $inventario]);
    }
}
