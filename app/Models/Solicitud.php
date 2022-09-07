<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'prefijo_codigo',
        'num_codigo',
        'sufijo_codigo',
        'descripcion',
        'observacion',
        'costo',
        'estado_id',
        'sucursal_id',
        'direccion_destinatario_id'
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function direccionDestinatario()
    {
        return $this->belongsTo(DireccionDestinatario::class);
    }

    public function historialMovimientos()
    {
        return $this->hasMany(HistorialMovimiento::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
