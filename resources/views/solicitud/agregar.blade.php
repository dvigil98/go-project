@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Solicitudes</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/solicitudes">Lista de solicitudes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agregar solicitud</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/solicitudes/guardar" method="post" id="submit">
                    @csrf                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripcion..." rows="4"></textarea>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Observacion</label>
                                        <textarea name="observacion" id="observacion" class="form-control @error('observacion') is-invalid @enderror" placeholder="Observacion..." rows="4"></textarea>
                                    </div>           
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select name="cliente_id" id="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            @foreach($clientes as $i)
                                            <option value="{{ $i->id }}">{{ $i->nombre }} {{ $i->apellido }}</option>
                                            @endforeach
                                        </select>
                                    </div>      
                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <select name="empresa_id" id="empresa_id" class="form-control @error('empresa_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>                                                                              
                                    <div class="form-group">
                                        <label>Sucursal</label>
                                        <select name="sucursal_id" id="sucursal_id" class="form-control @error('sucursal_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>                                                                              
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Destinatario</label>
                                        <select name="destinatario_id" id="destinatario_id" class="form-control @error('destinatario_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>                                                                              
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <select name="direccion_destinatario_id" id="direccion_destinatario_id" class="form-control @error('direccion_destinatario_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                        </select>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="departamento" readonly placeholder="Departamento"><br>
                                            <input class="form-control" type="text" id="municipio" readonly placeholder="Municipio"><br>
                                            <input class="form-control" type="text" id="direccion" readonly placeholder="Direccion"><br>
                                        </div>
                                    </div>     
                                    
                                    <div class="form-group">
                                        <label>Ruta</label>
                                        <select name="ruta_id" id="ruta_id" class="form-control @error('ruta_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            @foreach($rutas as $i)
                                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>      
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <select name="departamento_id" id="departamento_id" class="form-control @error('departamento_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>                                                                             
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Municipio</label>
                                        <select name="municipio_id" id="municipio_id" class="form-control @error('municipio_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Costo($)</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                            <a href="/solicitudes" class="btn btn-light">Cancelar</a>
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
    $('#solicitudes').addClass('active')  
    $('.selectpicker').selectpicker()
    $('#cliente_id').change(function() {
        let id = $('#cliente_id').val()
        $.get('/solicitudes/obtener-empresas/'+id, function(data) {
            let opt = '<option value="">Seleccione</option>'
            $('#sucursal_id').html(opt)
            $('#direccion_destinatario_id').html(opt)
            $('#departamento').val('')
            $('#municipio').val('')
            $('#direccion').val('')
            data.forEach(d => {
                opt += `<option value="${d.id}">${d.razon_social}</option>`
            })
            $('#empresa_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
        $.get('/solicitudes/obtener-destinatarios/'+id, function(data) {
            let optn = '<option value="">Seleccione</option>'
            data.forEach(d => {
                optn += `<option value="${d.id}">${d.nombre} ${d.apellido}</option>`
            })
            $('#destinatario_id').html(optn)
            $('.selectpicker').selectpicker('refresh')
        })
    })
    $('#empresa_id').change(function() {
        let id = $('#empresa_id').val()
        $.get('/solicitudes/obtener-sucursales/'+id, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}">${d.nombre}</option>`
            })
            $('#sucursal_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
    })
    $('#destinatario_id').change(function() {
        let id = $('#destinatario_id').val()
        $.get('/solicitudes/obtener-direcciones/'+id, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}">${d.nombre}</option>`
            })
            $('#direccion_destinatario_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
    })
    $('#direccion_destinatario_id').change(function() {
        let id = $('#direccion_destinatario_id').val()
        $.get('/solicitudes/obtener-direccion/'+id, function(data) {
            $('#departamento').val(data.departamento)
            $('#municipio').val(data.municipio)
            $('#direccion').val(data.direccion)
        })
    })
    $('#ruta_id').change(function() {
        let id = $('#ruta_id').val()
        $.get('/solicitudes/obtener-departamentos/'+id, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}">${d.nombre}</option>`
            })
            $('#departamento_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
    })
    $('#departamento_id').change(function() {
        let id = $('#departamento_id').val()
        $.get('/solicitudes/obtener-municipios/'+id, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}_${d.costo}">${d.nombre}</option>`
            })
            $('#municipio_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
    })
    $('#municipio_id').change(function() {
        let value = $('#municipio_id').val().split('_')
        $('#costo').val(value[1])
    })

    $("#submit").on("submit", function (e) {

        if ($("#departamento").val() !=  $("#departamento_id option:selected").text()) {
            alert('El departamento selecionado discrepa del departmaneto de direccion')
            e.preventDefault()
            return
        }
        
        if ($("#municipio").val() != $("#municipio_id option:selected").text()) {
            alert('El municipio selecionado discrepa del municipio de direccion')
            e.preventDefault()
            return
        }

    })
</script>
@endsection
