@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Solicitudes</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de solicitudes</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Historial de movimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="data">
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    @if (Auth::user()->rol->nombre == 'Administrador' || Auth::user()->rol->nombre == 'Gerente de logistica') <a href="/solicitudes/agregar" class="btn btn-primary">Agregar solicitud</a> @endif
                    <a href="/solicitudes" class="btn btn-primary" title="Recargar"><i class="fas fa-sync-alt"></i></a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>Id</th> -->
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Observacion</th>
                                        <th>Costo</th>
                                        <th>Empresa</th>
                                        <th>Destinatario</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($solicitudes as $i)
                                    <tr>
                                        <!-- <td>{{ $i->id }}</td> -->
                                        <td>{{ $i->prefijo_codigo }}{{ $i->num_codigo }}{{ $i->sufijo_codigo }}</td>
                                        <td>{{ $i->descripcion }}</td>
                                        <td>{{ $i->observacion }}</td>
                                        <td>${{ $i->costo }}</td>
                                        <td>{{ $i->sucursal->empresa->razon_social }}</td>
                                        <td>{{ $i->direccionDestinatario->destinatario->nombre }} {{ $i->direccionDestinatario->destinatario->apellido }}</td>
                                        <td>
                                            {{ $i->direccionDestinatario->direccion }},
                                            {{ $i->direccionDestinatario->municipio->nombre }},
                                            {{ $i->direccionDestinatario->municipio->departamento->nombre }}
                                        </td>
                                        <td>
                                            @if( $i->estado_id == 1 )
                                            <p class="font-weight-bold text-danger">Notifcado</p>
                                            @elseif( $i->estado_id == 2 )
                                            <p class="font-weight-bold text-warning">Recolectado</p>
                                            @elseif( $i->estado_id == 3 )
                                            <p class="font-weight-bold text-info">Enviado</p>
                                            @elseif( $i->estado_id == 4 )
                                            <p class="font-weight-bold text-info">Entregado</p>
                                            @else
                                            <p class="font-weight-bold text-purple">Devuelto a bodega</p>
                                            @endif
                                        </td>
                                        <td class="w-25 text-center">
                                            <div class="btn-group">
                                                <a data-toggle="modal" data-target="#exampleModal" href="#" class="btnHistorial btn btn-light" data-id="{{ $i->id }}" title="Historial"><i class="fas fa-history"></i></a>
                                                <a href="/solicitudes/detalles/{{ $i->id }}" class="btn btn-light" title="Detalles"><i class="fas fa-info-circle"></i></a>
                                                <!-- <a href="/solicitudes/editar/{{ $i->id }}" class="btn btn-light" title="Editar"><i class="fas fa-pen-alt"></i></a> -->
                                                <!-- <a href="#" data-toggle="modal" data-target="#exampleModal{{ $i->id }}" class="btn btn-light" title="Eliminar"><i class="fas fa-trash"></i></a> -->
                                            </div>
                                            <form action="/solicitudes/eliminar/{{ $i->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="exampleModal{{ $i->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                        </div>
                                                        <div class="modal-body">
                                                            <h3 class="text-center">¿Eliminar registro?</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Eliminar</button>
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('#solicitudes').addClass('active')
    $('.table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    })
    $('.btnHistorial').click(function() {
        let id = $(this).attr('data-id');
        console.log(id);
        $.get('/solicitudes/obtener-historial/'+id, function(data) {
            console.log(data);
            let tr = '';
            data.forEach(d => {
                tr += `
                <tr>
                    <td>${d.descripcion}</td>
                    <td>${
                        new Intl.DateTimeFormat("es-SV", { timezone: 'America/El_Salvador'}).format(new Date(`${d.fecha}`))
                    }</td>
                    <td>
                        ${ d.estado_id == 1 ? 'notificado' : '' }
                        ${ d.estado_id == 2 ? 'recolectado' : '' }
                        ${ d.estado_id == 3 ? 'enviado' : '' }
                        ${ d.estado_id == 4 ? 'entregado' : '' }
                        ${ d.estado_id == 5 ? 'devuelto a bodega' : '' }
                    </td>
                </tr>
                `
            })
            $('#data').html(tr)
        });
    })
</script>
@endsection
