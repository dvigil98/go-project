<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMovimiento extends Model
{
    use HasFactory;

    protected $table = 'historial_movimientos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha',
        'descripcion',
        'estado_id',
        'solicitud_id'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
