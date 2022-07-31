<?php 

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository {

	public function getAll() {
        try {
            return Cliente::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Cliente $cliente) {
        try {
            $cliente->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Cliente::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Cliente $cliente) {
        try {
            $cliente->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Cliente::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Cliente::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
