<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionDestinatario extends Model
{
    use HasFactory;

    protected $table = 'direcciones_destinatarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'municipio_id',
        'destinatario_id'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function destinatario()
    {
        return $this->belongsTo(Destinatario::class);
    }

}
