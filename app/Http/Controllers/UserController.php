<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function index() {
        $users = $this->userRepository->getAll();
        return view('user/index', ['users' => $users]);
    }

    public function agregar() {
        $roles = $this->userRepository->getRoles();
        return view('user/agregar', ['roles' => $roles]);
    }

    public function guardar(UserFormRequest $request) {
        $request->validated();
        $user = new User();
        $user->nombre = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->rol_id = $request->input('rol_id');
        $user->activo = 1;
        if ( $this->userRepository->save($user) ) 
            return redirect('/users/agregar')->with('msgType','success')->with('msg','Datos guardados');
        else
            return redirect('/users/agregar')->with('msgType','danger')->with('msg','Datos no guardados');
    }

    public function editar($id) {
        $user = $this->userRepository->getById($id);
        $roles = $this->userRepository->getRoles();
        return view('user/editar', ['user' => $user, 'roles' => $roles]);
    }

    public function actualizar(Request $request, $id) {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'rol_id' => 'required',
            'activo' => 'required'
        ]);
        $user = $this->userRepository->getById($id);
        $user->nombre = $request->input('nombre');
        $user->email = $request->input('email');
        if ( !empty($request->input('password')) )
            $user->password = Hash::make($request->input('password'));
        $user->rol_id = $request->input('rol_id');
        $user->activo = $request->input('activo');
        if ( $this->userRepository->update($user) ) 
            return redirect('/users')->with('msgType','success')->with('msg','Datos actualizados');
        else
            return redirect('/users')->with('msgType','danger')->with('msg','Datos no actualizados');
    }

    public function eliminar($id) {
        if ( $this->userRepository->delete($id) ) 
            return redirect('/users')->with('msgType','success')->with('msg','Datos eliminados');
        else
            return redirect('/users')->with('msgType','danger')->with('msg','Datos no eliminados');
    }

    public function detalles($id) {
        $user = $this->userRepository->getDetails($id);
        return view('user/detalles', ['user' => $user]);
    }
}
