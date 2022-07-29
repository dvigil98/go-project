<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Rol;

class UserRepository
{
    public function getAll() {
        try {
            return User::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(User $user) {
        try {
            $user->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return User::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(User $user) {
        try {
            $user->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            User::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return User::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    // External

    public function getRoles() {
        try {
            return Rol::all();
        } catch (\Throwable $th) {
            return null;
        }
    }
}
