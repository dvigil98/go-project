<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $table = 'rutas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function rutasDetalles()
    {
        return $this->hasMany(RutaDetalle::class);
    }

    public function envios()
    {
        return $this->hasMany(Envio::class);
    }
    
}
