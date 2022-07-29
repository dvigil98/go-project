<?php

namespace App\Repositories;

use App\Models\Municipio;
use App\Models\Departamento;

class MunicipioRepository
{
    public function getAll() {
        try {
            return Municipio::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Municipio $municipio) {
        try {
            $municipio->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Municipio::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Municipio $municipio) {
        try {
            $municipio->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Municipio::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Municipio::find($id);
        } catch (\Throwable $th) {
            return null;
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
}
