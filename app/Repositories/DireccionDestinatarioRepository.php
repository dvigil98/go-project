<?php

namespace App\Repositories;

use App\Models\DireccionDestinatario;
use App\Models\Departamento;
use App\Models\Municipio;

class DireccionDestinatarioRepository
{
    public function getAll($destinatario_id) {
        try {
            return DireccionDestinatario::where('destinatario_id', $destinatario_id)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getById($id) {
        try {
            return DireccionDestinatario::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(DireccionDestinatario $direccionDestinatario) {
        try {
            $direccionDestinatario->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update(DireccionDestinatario $direccionDestinatario) {
        try {
            $direccionDestinatario->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            DireccionDestinatario::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // External

    public function getDepartamentos() {
        try {
            return Departamento::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getMunicipiosPorDepartamento($departamento_id) {
        try {
            return Municipio::where('departamento_id', $departamento_id)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

}
