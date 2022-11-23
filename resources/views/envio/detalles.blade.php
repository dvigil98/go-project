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
                    <li class="breadcrumb-item active" aria-current="page">Detalles de envio</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="#" method="post">
        @csrf
            <div class="row">
                <div class="col-md-4">    
                    <div class="card">
                    <div class="card-header">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cambiar estado del envio
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/envios/{{ $envio->id }}/cambiar-estado/{{ $estado = 'En espera' }}">En espera</a>
                                <a class="dropdown-item" href="/envios/{{ $envio->id }}/cambiar-estado/{{ $estado = 'En ruta' }}">En ruta</a>
                                <a class="dropdown-item" href="/envios/{{ $envio->id }}/cambiar-estado/{{ $estado = 'Finalizado' }}">Finalizado</a>
                            </div>
                            </div>
                        </div>            
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $envio->nombre }}" readonly>
                                    </div>  
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="date" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $envio->fecha_delivery }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Conductor</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $envio->user->nombre }}" readonly>
                                    </div>  
                                    <div class="form-group">
                                        <label>Ruta</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $envio->ruta->nombre }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $envio->estado }}" readonly>
                                    </div>                              
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div> 
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-resposive">
                                <table class="table table-bordered table-striped">
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
                                        @foreach($detalles as $i)
                                        <tr>
                                            <td>{{ $i->inventario->solicitud->id }}</td>
                                            <td>{{ $i->inventario->solicitud->prefijo_codigo }}{{ $i->inventario->solicitud->num_codigo }}{{ $i->inventario->solicitud->sufijo_codigo }}</td>
                                            <td>{{ $i->inventario->solicitud->descripcion }}</td>
                                            <td>{{ $i->inventario->solicitud->observacion }}</td>
                                            <td>{{ $i->inventario->solicitud->direccionDestinatario->destinatario->nombre }} {{ $i->inventario->solicitud->direccionDestinatario->destinatario->apellido }}</td>
                                            <td>{{ $i->inventario->solicitud->direccionDestinatario->direccion }}, {{ $i->inventario->solicitud->direccionDestinatario->municipio->nombre }}, {{ $i->inventario->solicitud->direccionDestinatario->municipio->departamento->nombre }}</td>
                                            <td>
                                                @if($i->inventario->solicitud->estado_id == 3)
                                                <div class="btn-group">
                                                    <a href="/solicitudes/cambiar-estado/{{ $i->inventario->solicitud->id }}/4" class="btn btn-light" title="Entregar"><i class="fas fa-check-square"></i></a>
                                                    <a href="/solicitudes/cambiar-estado/{{ $i->inventario->solicitud->id }}/5" class="btn btn-light" title="Devolver a bodega"><i class="fas fa-undo-alt"></i></a>
                                                </div>
                                                @endif
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
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('#envios').addClass('active')
</script>
@endsection
