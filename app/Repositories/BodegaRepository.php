<?php

namespace App\Repositories;

use App\Models\Bodega;
use App\Models\Departamento;

class BodegaRepository
{
    public function getAll() {
        try {
            return Bodega::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Bodega $bodega) {
        try {
            $bodega->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Bodega::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Bodega $bodega) {
        try {
            $bodega->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Bodega::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Bodega::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    // External.

    public function getDepartamentos() {
        try {
            $departamentos = Departamento::all();
            return $departamentos;
        } catch (\Throwable $th) {
            return null;
        }
    }

}
