<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function historialMovimientos()
    {
        return $this->hasMany(HistorialMovimiento::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}
