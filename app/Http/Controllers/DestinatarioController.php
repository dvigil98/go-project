<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinatario;
use App\Repositories\DestinatarioRepository;
use App\Http\Requests\DestinatarioFormRequest;
use App\Models\DireccionDestinatario;
use App\Repositories\DireccionDestinatarioRepository;
use App\Http\Requests\DireccionDestinatarioFormRequest;

class DestinatarioController extends Controller
{
    private $destinatarioRepository;
    private $direccionDestinatarioRepository;

    public function __construct(DestinatarioRepository $destinatarioRepository, DireccionDestinatarioRepository $direccionDestinatarioRepository) {
        $this->destinatarioRepository = $destinatarioRepository;
        $this->direccionDestinatarioRepository = $direccionDestinatarioRepository;
        $this->middleware('auth');
    }

    public function index() {
        $destinatarios = $this->destinatarioRepository->getAll();
        return view('destinatario/index', ['destinatarios' => $destinatarios]);
    }

    public function agregar() {
        $clientes = $this->destinatarioRepository->getClientes();
        return view('destinatario/agregar', ['clientes' => $clientes]);
    }

    public function guardar(DestinatarioFormRequest $request) {
        $request->validated();
        $destinatario = new Destinatario();
        $destinatario->nombre = $request->input('nombre');
        $destinatario->apellido = $request->input('apellido');
        $destinatario->telefono = $request->input('telefono');
        $destinatario->dui = $request->input('dui');
        $destinatario->email = $request->input('email');
        $destinatario->cliente_id = $request->input('cliente_id');
        if ( $this->destinatarioRepository->save($destinatario) ) 
            return redirect('/destinatarios/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/destinatarios/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $destinatario = $this->destinatarioRepository->getById($id);
        $clientes = $this->destinatarioRepository->getClientes();
        return view('destinatario/editar', ['destinatario' => $destinatario, 'clientes' => $clientes]);
    }

    public function actualizar(DestinatarioFormRequest $request, $id) {
        $request->validated();
        $destinatario = $this->destinatarioRepository->getById($id);
        $destinatario->nombre = $request->input('nombre');
        $destinatario->apellido = $request->input('apellido');
        $destinatario->telefono = $request->input('telefono');
        $destinatario->dui = $request->input('dui');
        $destinatario->email = $request->input('email');
        $destinatario->cliente_id = $request->input('cliente_id');
        if ( $this->destinatarioRepository->update($destinatario) ) 
            return redirect('/destinatarios')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/destinatarios')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->destinatarioRepository->delete($id) ) 
            return redirect('/destinatarios')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/destinatarios')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $destinatario = $this->destinatarioRepository->getDetails($id);
        $direcciones = $this->direccionDestinatarioRepository->getAll($id);
        $departamentos = $this->direccionDestinatarioRepository->getDepartamentos();
        return view('destinatario/detalles', ['destinatario' => $destinatario, 'direcciones' => $direcciones, 'departamentos' => $departamentos]);
    }

    // direcciones

    public function guardarDireccion(DireccionDestinatarioFormRequest $request) {
        $request->validated();
        $direccion = new DireccionDestinatario();
        $direccion->nombre = $request->input('nombre');
        $direccion->direccion = $request->input('direccion');
        $direccion->telefono = $request->input('telefono');
        $direccion->municipio_id = $request->input('municipio_id');
        $direccion->destinatario_id = $request->input('destinatario_id');
        if ( $this->direccionDestinatarioRepository->save($direccion) ) 
            return redirect('/destinatarios/detalles/'.$direccion->destinatario_id)->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/destinatarios/detalles/'.$direccion->destinatario_id)->with('msgType','danger')->with('msg','Datos no guardados');
    }
    
    public function obtenerDireccion($id) {
        $direccion = $this->direccionDestinatarioRepository->getById($id);
        return $direccion;
    }

    public function actualizarDireccion(DireccionDestinatarioFormRequest $request) {
        $request->validated();
        $direccion = $this->direccionDestinatarioRepository->getById($request->input('direccion_id'));
        $direccion->nombre = $request->input('nombre');
        $direccion->direccion = $request->input('direccion');
        $direccion->telefono = $request->input('telefono');
        $direccion->municipio_id = $request->input('municipio_id');
        $direccion->destinatario_id = $request->input('destinatario_id');
        if ( $this->direccionDestinatarioRepository->update($direccion) ) 
            return redirect('/destinatarios/detalles/'.$direccion->destinatario_id)->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/destinatarios/detalles/'.$direccion->destinatario_id)->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function eliminarDireccion($id, Request $request) {
        if ( $this->direccionDestinatarioRepository->delete($id) ) 
            return redirect('/destinatarios/detalles/'.$request->destinatario_id)->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/destinatarios/detalles/'.$request->destinatario_id)->with('msgType','danger')->with('msg','Datos no eliminados');
    }

}
