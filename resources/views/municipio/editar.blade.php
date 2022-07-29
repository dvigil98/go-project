@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Municipios</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/municipios">Lista de municipios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar municipio</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/municipios/actualizar/{{ $municipio->id }}" method="post">
                    @csrf                
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre..." value="{{ $municipio->nombre }}">
                                    </div>   
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <select name="departamento_id" id="departamento_id" class="form-control @error('departamento_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            @foreach($departamentos as $i)
                                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                                         
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                            <a href="/municipios" class="btn btn-light">Cancelar</a>
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
    $('#municipios').addClass('active')
    $('.selectpicker').selectpicker()
    $('#departamento_id').val({{ $municipio->departamento_id }}).change()
</script>
@endsection
