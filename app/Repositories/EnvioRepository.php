<?php

namespace App\Repositories;

use App\Models\Envio;
use App\Models\EnvioDetalle;
use App\Models\User;
use App\Models\Ruta;
use App\Models\Solicitud;
use App\Models\Inventario;

class EnvioRepository
{
    public function getAll() {
        try {
            return Envio::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function saveMaestro(Envio $envio) {
        try {
            $envio->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function saveDetalle(EnvioDetalle $detalle) {
        try {
            $detalle->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Envio::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Envio $envio) {
        try {
            $envio->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Envio::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Envio::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    //

    public function getConductores() {
        try {
            $conductores = User::where('rol_id', 2)->where('activo', 1)->get();
            return $conductores;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getRutas() {
        try {
            $rutas = Ruta::all();
            return $rutas;
        } catch (\Throwable $th) {
            return null;
        }
    }


    public function getPaquetes() {
        try {
            $paquetes = Inventario::where('estado', 'Disponible')->get();
            return $paquetes;
        } catch (\Throwable $th) {
            return null;
        }
    }
    

}
