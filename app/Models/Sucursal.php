<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'activo',
        'municipio_id',
        'empresa_id'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
