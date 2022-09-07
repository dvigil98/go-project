<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\Destinatario;
use App\Models\DireccionDestinatario;
use App\Models\Ruta;
use App\Models\HistorialMovimiento;
use App\Models\Estado;


class SolicitudRepository
{
    public function getAll() {
        try {
            return Solicitud::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save(Solicitud $solicitud) {
        try {
            $solicitud->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getById($id) {
        try {
            return Solicitud::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function update(Solicitud $solicitud) {
        try {
            $solicitud->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id) {
        try {
            Solicitud::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getDetails($id) {
        try {
            return Solicitud::find($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    // External

    public function getClientes() {
        try {
            return Cliente::where('activo', 1)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getEmpresas($cliente_id) {
        try {
            return Empresa::where('cliente_id', $cliente_id)->where('activo', 1)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getSucursales($empresa_id) {
        try {
            return Sucursal::where('empresa_id', $empresa_id)->where('activo', 1)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getDestinatarios($cliente_id) {
        try {
            return Destinatario::where('cliente_id', $cliente_id)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getDireccionesDestinatario($destinatario_id) {
        try {
            return DireccionDestinatario::where('destinatario_id', $destinatario_id)->get();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getDireccion($direccion_id) {
        try {
            $direccion = DB::table('direcciones_destinatarios as dd')
            ->join('destinatarios  as d','dd.destinatario_id','d.id')
            ->join('municipios as m','dd.municipio_id','m.id')
            ->join('departamentos as dt','m.departamento_id','dt.id')
            ->select('dd.direccion', 'm.nombre as municipio', 'dt.nombre as departamento')
            ->where('dd.id', $direccion_id)->first();
            return $direccion;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getRutas() {
        try {
            return Ruta::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getDepartamentos($ruta_id) {
        try {
            $departamentos = DB::table('rutas_detalles as rd')
            ->join('rutas as r', 'rd.ruta_id', 'r.id')
            ->join('municipios as m', 'rd.municipio_id', 'm.id')
            ->join('departamentos as d', 'm.departamento_id', 'd.id')
            ->select('d.id', 'd.nombre')->where('r.id', $ruta_id)->groupBy('d.id')->get();
            return $departamentos;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getMunicipios($departamento_id) {
        try {
            $departamentos = DB::table('rutas_detalles as rd')
            ->join('rutas as r', 'rd.ruta_id', 'r.id')
            ->join('municipios as m', 'rd.municipio_id', 'm.id')
            ->join('departamentos as d', 'm.departamento_id', 'd.id')
            ->select('m.id', 'm.nombre', 'rd.costo')->where('d.id', $departamento_id)->groupBy('m.id')->get();
            return $departamentos;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function guardarHistorial(HistorialMovimiento $historial) {
        try {
            $historial->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function obtenerHistorialPorSolicitud($solicitud_id)
    {
        try 
        {
            return HistorialMovimiento::where('solicitud_id', $solicitud_id)->get();
        } 
        catch (\Throwable $th)
        {
            return null;
        }
    }

    public function obtenerEstados() {
        try {
            return Estado::all();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function obtenerHistorialPorCodigo($codigo)
    {
        try 
        {
            $historial = DB::table('historial_movimientos as hm')
            ->join('solicitudes as s', 'hm.solicitud_id', 's.id')
            ->join('estados as e', 'hm.estado_id', 'e.id')
            ->select('hm.descripcion', 'hm.fecha', 'e.nombre')->where('s.num_codigo', $codigo)->get();
            return $historial;
        } 
        catch (\Throwable $th)
        {
            return null;
        }
    }

    public function obtenerSolicitudPorCodigo($codigo) {
        try {
            return Solicitud::where('num_codigo', $codigo)->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

}
