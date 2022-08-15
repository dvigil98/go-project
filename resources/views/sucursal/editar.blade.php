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
                    <li class="breadcrumb-item active" aria-current="page">Editar sucursal</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/sucursales/actualizar/{{ $sucursal->id }}" method="post">
                    @csrf                
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre..." value="{{ $sucursal->nombre }}">
                                    </div>  
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Telefono..." value="{{ $sucursal->telefono }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion..." value="{{ $sucursal->direccion }}">
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
                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <select name="empresa_id" id="empresa_id" class="form-control @error('empresa_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            @foreach($empresas as $i)
                                            <option value="{{ $i->id }}">{{ $i->razon_social }}</option>
                                            @endforeach
                                        </select>
                                    </div>    
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select name="activo" id="activo" class="form-control @error('activo') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>                                                        
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                            <a href="/sucursales" class="btn btn-light">Cancelar</a>
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
    $('.selectpicker').selectpicker()
    $('#departamento_id').val({{ $sucursal->municipio->departamento->id }}).change(cargarMunicipios())
    $('#empresa_id').val({{ $sucursal->empresa_id }}).change()
    $('#activo').val({{ $sucursal->activo }}).change()
    $('#departamento_id').change(function() {
        cargarMunicipios()
    })
    function cargarMunicipios() {
        let departamentoId = $('#departamento_id').val();
        $.get('/sucursales/municipios/departamento/'+departamentoId, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}" ${ (d.id == {{ $sucursal->municipio_id}}) ? 'selected' : '' }>${d.nombre}</option>`
            })
            $('#municipio_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
    }

</script>
@endsection
