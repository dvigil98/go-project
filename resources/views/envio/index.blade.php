@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Envios</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de envios</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                @if (Auth::user()->rol->nombre == 'Administrador' || Auth::user()->rol->nombre == 'Gerente de logistica') <a href="/envios/agregar" class="btn btn-primary">Agregar envio</a> @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>Id</th> -->
                                        <th>Envio</th>
                                        <th>Fecha delivery</th>
                                        <th>Conductor</th>
                                        <th>Ruta</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($envios as $i)
                                    <tr>
                                        <!-- <td>{{ $i->id }}</td> -->
                                        <td>{{ $i->nombre }}</td>
                                        <?php $date = date_create($i->fecha_delivery); ?>
                                        <td><?php echo date_format($date, 'd-m-Y'); ?></td>
                                        <td>{{ $i->user->nombre }}</td>
                                        <td>{{ $i->ruta->nombre }}</td>
                                        <td>
                                            @if( $i->estado == 'En espera')
                                            <span class="font-weight-bold text-danger">{{ $i->estado }}</span>
                                            @elseif( $i->estado == 'En ruta')
                                            <span class="font-weight-bold text-warning">{{ $i->estado }}</span>
                                            @else
                                            <span class="font-weight-bold text-success">{{ $i->estado }}</span>
                                            @endif
                                        </td>
                                        <td class="w-25 text-center">
                                            <div class="btn-group">
                                                <a href="/envios/detalles/{{ $i->id }}" class="btn btn-light" title="Detalles"><i class="fas fa-info-circle"></i></a>
                                                <!-- <a href="/envios/editar/{{ $i->id }}" class="btn btn-light" title="Editar"><i class="fas fa-pen-alt"></i></a> -->
                                                <!-- <a href="#" data-toggle="modal" data-target="#exampleModal{{ $i->id }}" class="btn btn-light" title="Eliminar"><i class="fas fa-trash"></i></a> -->
                                            </div>
                                            <form action="/envios/eliminar/{{ $i->id }}" method="post">
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
    $('#envios').addClass('active')
    $('.table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    })
</script>
@endsection
