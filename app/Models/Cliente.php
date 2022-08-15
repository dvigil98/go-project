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
        'nombre',
        'apellido',
        'dui',
        'email',
        'password',
        'activo'
    ];

    public function empresas()
    {
        return $this->hasMany(Empresas::class);
    }
}
