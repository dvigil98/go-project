<?php

namespace App\Repositories;

use App\Models\Empresa;
use App\Models\Cliente;

class EmpresaRepository
{
    public function getAll() {
        try {
            return Empresa::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Empresa $empresa) {
        try {
            $empresa->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Empresa::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Empresa $empresa) {
        try {
            $empresa->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Empresa::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Empresa::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    // External

    public function getClientes() {
        try {
            return Cliente::where('activo', 1)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

}
