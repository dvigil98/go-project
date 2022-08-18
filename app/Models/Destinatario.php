<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinatario extends Model
{
    use HasFactory;

    protected $table = 'destinatarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'dui',
        'email',
        'cliente_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function direcciones()
    {
        return $this->hasMany(DireccionDestinatario::class);
    }
}
