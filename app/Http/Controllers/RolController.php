<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Repositories\RolRepository;
use App\Http\Requests\RolFormRequest;

class RolController extends Controller
{
    private $rolRepository;

    public function __construct(RolRepository $rolRepository) {
        $this->rolRepository = $rolRepository;
        $this->middleware('auth');
    }

    public function index() {
        $roles = $this->rolRepository->getAll();
        return view('rol/index', ['roles' => $roles]);
    }
}
