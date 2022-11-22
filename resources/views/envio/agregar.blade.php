@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Envios</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/envios">Lista de envios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agregar envio</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="/envios/guardar" method="post">  
        @csrf  
            <div class="row">
                <div class="col-md-4">          
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre..." readonly value="Envio #{{ time() }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="date" name="fecha_delivery" id="fecha_delivery" class="form-control @error('fecha_delivery') is-invalid @enderror" placeholder="Fecha...">
                                    </div>
                                    <div class="form-group">
                                        <label>Conductor</label>
                                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            @foreach($conductores as $i)
                                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                                            @endforeach
                                        </select>
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
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-repsonsive">
                                <table class="table table-bordered table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Codigo</th>
                                            <th>Paquete</th>
                                            <th>Observacion</th>
                                            <th>Destinatario</th>
                                            <th>Direccion</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paquetes as $i)
                                        <tr>
                                            <td>{{ $i->id }}</td>
                                            <td>{{ $i->solicitud->prefijo_codigo }}{{ $i->solicitud->num_codigo }}{{ $i->solicitud->sufijo_codigo }}</td>
                                            <td>{{ $i->solicitud->descripcion }}</td>
                                            <td>{{ $i->solicitud->observacion }}</td>
                                            <td>{{ $i->solicitud->direccionDestinatario->destinatario->nombre }} {{ $i->solicitud->direccionDestinatario->destinatario->apellido }}</td>
                                            <td>{{ $i->solicitud->direccionDestinatario->direccion }}, {{ $i->solicitud->direccionDestinatario->municipio->nombre }}, {{ $i->solicitud->direccionDestinatario->municipio->departamento->nombre }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btnAdd btn btn-light" title="Agregar"
                                                    data-solicitudId="{{ $i->solicitud->id }}"
                                                    data-inventarioId="{{ $i->id }}"
                                                    data-codigo="{{ $i->solicitud->prefijo_codigo }}{{ $i->solicitud->num_codigo }}{{ $i->solicitud->sufijo_codigo }}"
                                                    data-paquete="{{ $i->solicitud->descripcion }}"
                                                    data-observacion="{{ $i->solicitud->observacion }}"
                                                    data-destinatario="{{ $i->solicitud->direccionDestinatario->destinatario->nombre }} {{ $i->solicitud->direccionDestinatario->destinatario->apellido }}"
                                                    data-direccion="{{ $i->solicitud->direccionDestinatario->direccion }}, {{ $i->solicitud->direccionDestinatario->municipio->nombre }}, {{ $i->solicitud->direccionDestinatario->municipio->departamento->nombre }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex border-0">
                            <a href="#" class="ml-auto btn btn-primary"  data-toggle="modal" data-target="#exampleModal">Ver Paquetes</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                            <th>Codigo</th>
                                            <th>Paquete</th>
                                            <th>Observacion</th>
                                            <th>Destinatario</th>
                                            <th>Direccion</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="guardar">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                                <a href="/envios" class="btn btn-light">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('#envios').addClass('active')
    $('.selectpicker').selectpicker()
    $('#dt').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    })

    $('#guardar').hide()
    let cont = 0

    $('.btnAdd').click(function() {
        let solicitudId = $(this).attr('data-solicitudId')
        let inventarioId = $(this).attr('data-inventarioId')
        let codigo = $(this).attr('data-codigo')
        let paquete = $(this).attr('data-paquete')
        let observacion = $(this).attr('data-observacion')
        let destinatario = $(this).attr('data-destinatario')
        let direccion = $(this).attr('data-direccion')

        if (inventarioId != '') {	    
            let fila = '<tr class="selected" id="fila'+cont+'">'
            fila += '<td><input type="hidden" name="solicitudId[]" value="'+solicitudId+'"/><input type="hidden" name="inventarioId[]" value="'+inventarioId+'"/>'+inventarioId+'</td>'
            fila += '<td>'+codigo+'</td>'
            fila += '<td>'+paquete+'</td>'
            fila += '<td>'+observacion+'</td>'
            fila += '<td>'+destinatario+'</td>'
            fila += '<td>'+direccion+'</td>'
            fila += '<td class="text-center"><button type="button" class="btn btn-light" onclick="eliminar('+cont+')" title="Eliminar"><i class="fas fa-trash"></i></button></td>'
            fila += '</tr>'
            cont++
            $('#data').append(fila)
            limpiar()
            evaluar()
        }        

    })

    function evaluar() {
        if (cont > 0) {
            $('#guardar').show()
        } else {
            $('#guardar').hide()
        }
    }
    function eliminar(idFila) {
        $('#fila' + idFila).remove();
        cont--
        evaluar()
    }
    function limpiar() {
        $('#b_municipio_id').val('')
        $('#b_costo').val('')
        $('.selectpicker').selectpicker('refresh')
    }

</script>
@endsection
