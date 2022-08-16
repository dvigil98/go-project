<?php

namespace App\Repositories;

use App\Models\Destinatario;
use App\Models\Cliente;

class DestinatarioRepository
{
    public function getAll() {
        try {
            return Destinatario::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Destinatario $destinatario) {
        try {
            $destinatario->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Destinatario::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Destinatario $destinatario) {
        try {
            $destinatario->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Destinatario::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Destinatario::find($id);
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
