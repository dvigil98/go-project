@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Empresas</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/empresas">Lista de empresas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles de empresa</li>
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
                                        <input type="text" name="razon_social" id="razon_social" class="form-control" placeholder="Razon social..." value="{{ $empresa->razon_social }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Cliente..." value="{{ $empresa->cliente->nombre }} {{ $empresa->cliente->apellido }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" name="activo" id="activo" class="form-control" placeholder="Estado..." value="@if( $empresa->activo == 1) Activo @else Inactivo @endif" readonly>
                                    </div>                              
                                </div>
                                <div class="col-md-4">
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
    $('#empresas').addClass('active')
</script>
@endsection
