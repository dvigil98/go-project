<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Repositories\SolicitudRepository;
use Illuminate\Support\Facades\DB;

class TrackController extends Controller
{

    private $solicitudRepsitory;

    public function __construct(SolicitudRepository $solicitudRepsitory) {
        $this->solicitudRepository = $solicitudRepsitory;
    }

    public function trackView() {
        return view('solicitud/track');
    }

    public function obtenerHistorialPorCodigo($codigo) {
        $historial = $this->solicitudRepository->obtenerHistorialPorCodigo($codigo);
        return $historial;
    }

    public function obtenerSolicitudPorCodigo($codigo) {
        $solicitud = DB::table('solicitudes as s')
        ->join('direcciones_destinatarios as dd', 's.direccion_destinatario_id','dd.id ')
        ->join('destinatarios as d', 'dd.destinatario_id', 'd.id ')
        ->join('municipios as m', 'dd.municipio_id', 'm.id ')
        ->join('departamentos as dt', 'm.departamento_id', 'dt.id')
        ->select(
            DB::raw('CONCAT(s.prefijo_codigo, s.num_codigo, s.sufijo_codigo) as codigo'),
            DB::raw('CONCAT(d.nombre," ",d.apellido) as receptor'),
            DB::raw('CONCAT(dd.direccion,",",m.nombre,",",dt.nombre) as direccion'),
            's.descripcion as descripcion',
            's.observacion as observacion'
        )->where('s.num_codigo', $codigo)->get();
        return $solicitud;
    }
}
