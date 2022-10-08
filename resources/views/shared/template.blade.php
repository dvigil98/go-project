<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <title>Go Project</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" height="60" width="60">
        </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light border-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->nombre }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Configuraciones</a>
                        <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-white elevation-0">
            <a href="#" class="brand-link border-0">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" class="brand-image img-circle elevation-0" style="opacity: .8">
                <span class="brand-text font-weight-light">Go Project</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">Principal</li>  
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link" id="dashboard">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li> 
                        <!-- Solo para admin -->
                        @if (Auth::user()->rol->nombre == 'Administrador')
                        <li class="nav-item">
                            <a href="/rutas" class="nav-link" id="rutas">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Rutas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/clientes" class="nav-link" id="clientes">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/empresas" class="nav-link" id="empresas">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Empresas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sucursales" class="nav-link" id="sucursales">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Sucursales</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/destinatarios" class="nav-link" id="destinatarios">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Destinatarios</p>
                            </a>
                        </li>
                        @endif
                        <!--  -->
                        
                        <li class="nav-item">
                            <a href="/solicitudes" class="nav-link" id="solicitudes">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Solicitudes</p>
                            </a>
                        </li>

                        <!-- Solo para admin y gerente -->
                        @if(Auth::user()->rol->nombre == 'Administrador' || Auth::user()->rol->nombre == 'Gerente de logistica')
                        <li class="nav-item">
                            <a href="/inventarios" class="nav-link" id="inventarios">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Inventarios</p>
                            </a>
                        </li>
                        @endif
                        <!-- -->
                        
                        <li class="nav-item">
                            <a href="/envios" class="nav-link" id="envios">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Envios</p>
                            </a>
                        </li>

                        <!-- Solo para admin -->
                        @if(Auth::user()->rol->nombre == 'Administrador')
                        <li class="nav-header">Configuraciones</li>
                        <li class="nav-item">
                            <a href="/departamentos" class="nav-link" id="departamentos">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Departamentos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/municipios" class="nav-link" id="municipios">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Municipios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/bodegas" class="nav-link" id="bodegas">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Bodegas</p>
                            </a>
                        </li>
                        <li class="nav-header">Accesos</li>
                        <li class="nav-item">
                            <a href="/roles" class="nav-link" id="roles">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link" id="users">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        @endif
                        <!-- -->
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            @include('shared/messages')
            @yield('contenido')
        </div>
        <footer class="main-footer border-0">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2022 <a href="#">Go Project.</a></strong> Todos los derechos reservados.
        </footer>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/js/i18n/defaults-es_ES.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
