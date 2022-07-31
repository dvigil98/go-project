@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Clientes</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de clientes</li>
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
                    <a href="/clientes/agregar" class="btn btn-primary">Agregar cliente</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>Id</th> -->
                                        <th>Razon social</th>
                                        <th>Representante</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $i)
                                    <tr>
                                        <!-- <td>{{ $i->id }}</td> -->
                                        <td>{{ $i->razon_social }}</td>
                                        <td>{{ $i->representante }}</td>
                                        <td>
                                            @if( $i->activo == 1 )
                                            <p class="font-weight-bold text-success">Activo</p>
                                            @else
                                            <p class="font-weight-bold text-danger">Inactivo</p>
                                            @endif
                                        </td>
                                        <td class="w-25 text-center">
                                            <div class="btn-group">
                                                <a href="/clientes/detalles/{{ $i->id }}" class="btn btn-light" title="Detalles"><i class="fas fa-info-circle"></i></a>
                                                <a href="/clientes/editar/{{ $i->id }}" class="btn btn-light" title="Editar"><i class="fas fa-pen-alt"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#exampleModal{{ $i->id }}" class="btn btn-light" title="Eliminar"><i class="fas fa-trash"></i></a>
                                            </div>
                                            <form action="/clientes/eliminar/{{ $i->id }}" method="post">
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
    $('#clientes').addClass('active')
    $('.table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    })
</script>
@endsection
