<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'departamento_id'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function rutasDetalles()
    {
        return $this->hasMany(RutaDetalle::class);
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function direcciones()
    {
        return $this->hasMany(DireccionDestinatario::class);
    }

    public function bodegas()
    {
        return $this->hasMany(Bodega::class);
    }
}
