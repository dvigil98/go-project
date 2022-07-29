<?php

namespace App\Repositories;

use App\Models\Rol;

class RolRepository
{
    public function getAll() {
        try {
            return Rol::all();
        } catch (\Throwable $th) {
            return null;
        }
    }
}
