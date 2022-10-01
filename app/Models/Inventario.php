<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'bodega_id',
        'solicitud_id',
        'estado'
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class);
    }

    public function enviosDetalles()
    {
        return $this->hasMany(EnvioDetalle::class);
    }

}
