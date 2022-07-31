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
                                        <label>Razon social</label>
                                        <input type="text" name="razon_social" id="razon_social" class="form-control" placeholder="Razon social..." value="{{ $cliente->razon_social }}" readonly>
                                    </div>         
                                    <div class="form-group">
                                        <label>Representante</label>
                                        <input type="text" name="representante" id="representante" class="form-control" placeholder="Representante..." value="{{ $cliente->representante }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>DUI</label>
                                        <input type="text" name="dui" id="dui" class="form-control" placeholder="DUI..." value="{{ $cliente->dui }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>NIT</label>
                                        <input type="text" name="nit" id="nit" class="form-control" placeholder="NIT..." value="{{ $cliente->nit }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono..." value="{{ $cliente->telefono }}" readonly>
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
