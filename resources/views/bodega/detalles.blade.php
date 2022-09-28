@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Bodegas</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/bodegas">Lista de bodegas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles de bodegas</li>
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
                                        <input readonly type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre..." value="{{ $bodega->nombre }}">
                                    </div>   
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <input readonly type="text" name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripcion..." value="{{ $bodega->descripcion }}">
                                    </div>   
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input readonly type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion..." value="{{ $bodega->direccion }}">
                                    </div>   
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <input readonly type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion..." value="{{ $bodega->municipio->nombre }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>Municipio</label>
                                        <input readonly type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion..." value="{{ $bodega->municipio->departamento->nombre }}">
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
    $('#bodegas').addClass('active')
</script>
@endsection
