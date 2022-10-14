<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Authenticatable
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'dui',
        'email',
        'password',
        'activo'
    ];

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    public function destinatarios()
    {
        return $this->hasMany(Destinatario::class);
    }
}
