<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutaDetalle extends Model
{
    use HasFactory;

    protected $table = 'rutas_detalles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'costo',
        'municipio_id',
        'ruta_id'
    ];

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
