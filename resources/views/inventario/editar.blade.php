@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Inventarios</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/inventarios">Lista de inventarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar inventario</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/inventarios/actualizar/{{ $inventario->id }}" method="post">
                    @csrf                
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Bodega</label>
                                        <select name="bodega_id" id="bodega_id" class="form-control @error('bodega_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            @foreach($bodegas as $i)
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
                            <a href="/departamentos" class="btn btn-light">Cancelar</a>
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
    $('#inventarios').addClass('active')
    $('.selectpicker').selectpicker()
    $('#bodega_id').val({{ $inventario->bodega_id }}).change()
</script>
@endsection
