<?php

namespace App\Repositories;

use App\Models\Inventario;
use App\Models\Bodega;

class InventarioRepository
{
    public function getAll() {
        try {
            return Inventario::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Inventario $inventario) {
        try {
            $inventario->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Inventario::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Inventario $inventario) {
        try {
            $inventario->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Inventario::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Inventario::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    //

    public function getBodegas() {
        try {
            $bodegas = Bodega::all();
            return $bodegas;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
