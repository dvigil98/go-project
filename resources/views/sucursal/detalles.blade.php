@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Sucursales</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/sucursales">Lista de sucursales</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles de sucursal</li>
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
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $sucursal->nombre }}" readonly>
                                    </div>   
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono..." value="{{ $sucursal->telefono }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion..." value="{{ $sucursal->direccion }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <input type="text" name="departamento" id="departamento" class="form-control" placeholder="Departamento..." value="{{ $sucursal->municipio->departamento->nombre }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Municipio</label>
                                        <input type="text" name="municipio" id="municipio" class="form-control" placeholder="Municipio..." value="{{ $sucursal->municipio->nombre }}" readonly>
                                    </div>                                                          
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa..." value="{{ $sucursal->empresa->razon_social }}" readonly>
                                    </div>    
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" name="activo" id="activo" class="form-control" placeholder="Estado..." value="@if( $sucursal->activo == 1) Activo @else Inactivo @endif" readonly>
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
    $('#sucursales').addClass('active')
</script>
@endsection
