<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    private $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
        $this->middleware('auth');
    }
    
    public function dashboard() {
        $numeroDeClientes = $this->dashboardRepository->obtenerNumeroDeClientes();
        $numeroDeEmpresas = $this->dashboardRepository->obtenerNumeroDeEmpresas();
        $numeroDeSucursales = $this->dashboardRepository->obtenerNumeroDeSucursales();
        $numeroDeSolicitudes = $this->dashboardRepository->obtenerNumeroDeSolicitudes();
        $numeroDeSolicitudesPorMes = $this->dashboardRepository->obtenerNumeroDeSolicitudesPorMes(date('Y'));  
        $numeroDeEnviosPorMes = $this->dashboardRepository->obtenerNumeroDeEnviosPorMes(date('Y'));        
        return view('dashboard/dashboard', [
            'numeroDeClientes' => $numeroDeClientes,
            'numeroDeEmpresas' => $numeroDeEmpresas,
            'numeroDeSucursales' => $numeroDeSucursales,
            'numeroDeSolicitudes' => $numeroDeSolicitudes,
            'numeroDeSolicitudesPorMes' => $numeroDeSolicitudesPorMes,
            'numeroDeEnviosPorMes' => $numeroDeEnviosPorMes
        ]);
    }
}
