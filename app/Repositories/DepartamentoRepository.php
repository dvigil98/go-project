<?php

namespace App\Repositories;

use App\Models\Departamento;

class DepartamentoRepository
{
    public function getAll() {
        try {
            return Departamento::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Departamento $departamento) {
        try {
            $departamento->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Departamento::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Departamento $departamento) {
        try {
            $departamento->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Departamento::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Departamento::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
