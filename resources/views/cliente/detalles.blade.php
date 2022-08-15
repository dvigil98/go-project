@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Clientes</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/clientes">Lista de clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles de cliente</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="#" method="post">
                    @csrf                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $cliente->nombre }}" readonly>
                                    </div>         
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido..." value="{{ $cliente->apellido }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>DUI</label>
                                        <input type="text" name="dui" id="dui" class="form-control" placeholder="DUI..." value="{{ $cliente->dui }}" readonly>
                                    </div>                              
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email..." value="{{ $cliente->email }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña..." readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" name="activo" id="activo" class="form-control" placeholder="Estado..." value="@if( $cliente->activo == 1) Activo @else Inactivo @endif" readonly>
                                    </div>                              
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('#departamentos').addClass('active')
</script>
@endsection
