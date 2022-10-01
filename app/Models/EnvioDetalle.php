<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioDetalle extends Model
{
    use HasFactory;

    protected $table = 'envios_detalles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'envio_id',
        'inventario_id'
    ];

    public function envio()
    {
        return $this->belongsTo(Envio::class);
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }

}
