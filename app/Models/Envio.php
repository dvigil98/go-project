<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $table = 'envios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'fecha_delivery',
        'estado',
        'user_id',
        'ruta_id'
    ];

    public function enviosDetalles()
    {
        return $this->hasMany(EnvioDetalle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }

}
