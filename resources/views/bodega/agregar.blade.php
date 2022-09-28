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
                    <li class="breadcrumb-item active" aria-current="page">Agregar bodega</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/bodegas/guardar" method="post">
                    @csrf                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre...">
                                    </div>   
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <input type="text" name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripcion...">
                                    </div>   
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion...">
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
                                    <div class="form-group">
                                        <label>Municipio</label>
                                        <select name="municipio_id" id="municipio_id" class="form-control @error('municipio_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
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
                                Guardar
                            </button>
                            <a href="/bodegas" class="btn btn-light">Cancelar</a>
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
    $('.selectpicker').selectpicker()
    $('#departamento_id').change(function() {
        let departamentoId = $('#departamento_id').val();
        $.get('/sucursales/municipios/departamento/'+departamentoId, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}">${d.nombre}</option>`
            })
            $('#municipio_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
    })
</script>
@endsection
