<?php

namespace App\Repositories;

use App\Models\Ruta;
use App\Models\RutaDetalle;
use App\Models\Departamento;
use App\Models\Municipio;

class RutaRepository
{
    public function getAll() {
        try {
            return Ruta::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Ruta $ruta) {
        try {
            $ruta->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function saveDetails(RutaDetalle $rutaDetalle) {
        try {
            $rutaDetalle->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Ruta::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getDetails($id) {
        try {
            return Ruta::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function delete($id) {
        try {
            RutaDetalle::where('ruta_id',$id)->delete();
            Ruta::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getRutasDetalles($ruta_id) {
        try {
            return RutaDetalle::where('ruta_id', $ruta_id)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteDetail($id) {
        try {
            RutaDetalle::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetailById($id) {
        try {
            return RutaDetalle::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function updateDetail(RutaDetalle $rutaDetalle) {
        try {
            $rutaDetalle->save();
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
