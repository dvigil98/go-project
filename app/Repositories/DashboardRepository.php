<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function obtenerNumeroDeClientes() {
        try {
            $numeroDeClientes = DB::table('clientes')->count();
            return $numeroDeClientes;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function obtenerNumeroDeEmpresas() {
        try {
            $numeroDeEmpresas = DB::table('empresas')->count();
            return $numeroDeEmpresas;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function obtenerNumeroDeSucursales() {
        try {
            $numeroDeSucursales = DB::table('sucursales')->count();
            return $numeroDeSucursales;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function obtenerNumeroDeSolicitudes() {
        try {
            $numeroDeSolicitudes = DB::table('solicitudes')->count();
            return $numeroDeSolicitudes;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function obtenerNumeroDeSolicitudesPorMes($año) {
        try {
            $numeroDeSolicitudesPorMes = DB::table('solicitudes')
            ->select(DB::raw('COUNT(id) as solicitudes'), DB::raw('MONTH(created_at) as mes'))
            ->whereBetween('created_at', [$año.'/01/01', $año.'/12/31'])->groupBy(DB::raw('MONTH(created_at)'))->get();  
            return $numeroDeSolicitudesPorMes;
        } catch (\Throwable $th) {  
            return null;
        }
    }

    public function obtenerNumeroDeEnviosPorMes($año) {
        try {
            $numeroDeEnviosPorMes = DB::table('envios')
            ->select(DB::raw('COUNT(id) as envios'), DB::raw('MONTH(fecha_delivery) as mes'))
            ->whereBetween('created_at', [$año.'/01/01', $año.'/12/31'])->groupBy(DB::raw('MONTH(fecha_delivery)'))->get();  
            return $numeroDeEnviosPorMes;
        } catch (\Throwable $th) {  
            return null;
        }
    }

}
