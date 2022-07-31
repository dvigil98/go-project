<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use App\Http\Requests\ClienteFormRequest;

class ClienteController extends Controller
{
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository) {
        $this->clienteRepository = $clienteRepository;
        $this->middleware('auth');
    }

    public function index() {
        $clientes = $this->clienteRepository->getAll();
        return view('cliente/index', ['clientes' => $clientes]);
    }

    public function agregar() {
        return view('cliente/agregar', []);
    }

    public function guardar(ClienteFormRequest $request) {
        $request->validated();
        $cliente = new cliente();
        $cliente->razon_social = $request->input('razon_social');
        $cliente->representante = $request->input('representante');
        $cliente->dui = $request->input('dui');
        $cliente->nit = $request->input('nit');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->password = Hash::make($request->input('password'));
        $cliente->activo = 0;
        if ( $this->clienteRepository->save($cliente) ) 
            return redirect('/clientes/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/clientes/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $cliente = $this->clienteRepository->getById($id);
        return view('cliente/editar', ['cliente' => $cliente]);
    }

    public function actualizar(Request $request, $id) {
        $request->validate([
            'razon_social' => 'required',
            'representante' => 'required',
            'dui' => 'required',
            'nit' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'activo' => 'required'
        ]);
        $cliente = $this->clienteRepository->getById($id);
        $cliente->razon_social = $request->input('razon_social');
        $cliente->representante = $request->input('representante');
        $cliente->dui = $request->input('dui');
        $cliente->nit = $request->input('nit');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        if ( !empty($request->input('password')) )
            $cliente->password = Hash::make($request->input('password'));
        $cliente->activo = $request->input('activo');
        if ( $this->clienteRepository->update($cliente) ) 
            return redirect('/clientes')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/clientes')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->clienteRepository->delete($id) ) 
            return redirect('/clientes')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/clientes')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $cliente = $this->clienteRepository->getDetails($id);
        return view('cliente/detalles', ['cliente' => $cliente]);
    }
}
