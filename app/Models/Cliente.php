<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'razon_social',
        'representante',
        'dui',
        'nit',
        'telefono',
        'email',
        'password',
        'activo'
    ];
}
