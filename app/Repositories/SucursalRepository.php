<?php

namespace App\Repositories;

use App\Models\Sucursal;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Empresa;

class SucursalRepository
{
    public function getAll() {
        try {
            return Sucursal::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Sucursal $sucursal) {
        try {
            $sucursal->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Sucursal::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Sucursal $sucursal) {
        try {
            $sucursal->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Sucursal::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Sucursal::find($id);
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

    public function getMunicipiosPorDepartamento($departamento_id) {
        try {
            return Municipio::where('departamento_id', $departamento_id)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getEmpresas() {
        try {
            return Empresa::where('activo', 1)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

}
