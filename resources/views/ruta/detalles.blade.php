@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Rutas</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/rutas">Lista de rutas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles de ruta</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<form action="/rutas/editar/detalle" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header border-0">
            </div>
            <div class="modal-body">
                <input type="hidden" name="detalle_id" id="detalle_id">
                <input type="hidden" name="ruta_id" value="{{ $ruta->id }}">
                <div class="form-group">
                    <label>Precio</label>
                    <input type="number" name="costo" id="costo" class="form-control" placeholder="Costo...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            </div>
            </div>
        </div>
    </div>
</form>
<form action="/rutas/agregar/municipio" method="post">
    @csrf
    <div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header border-0">
            </div>
            <div class="modal-body">
                <input type="hidden" name="detalle_id" id="detalle_id">
                <input type="hidden" name="ruta_id" value="{{ $ruta->id }}">
                <div class="form-group">
                    <div class="form-group">
                        <label>Departamento</label>
                        <select name="departamento_id" id="departamento_id" class="form-control selectpicker" data-live-search="true">
                            <option value="">Seleccione</option>
                            @foreach($departamentos as $i)
                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                            @endforeach
                        </select>
                    </div>                              
                    <div class="form-group">
                        <label>Municipio</label>
                        <select name="municipio_id" id="municipio_id" class="form-control selectpicker" data-live-search="true">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Costo</label>
                        <input type="number" name="costo" id="costo" class="form-control" placeholder="Costo...">
                    </div>                              
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Agregar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            </div>
            </div>
        </div>
    </div>
</form>
<section class="content">
    <div class="container-fluid">
        <form action="#" method="post">
            @csrf                
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $ruta->nombre }}" readonly>
                            </div>                              
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea name="descripcion" id="descripcion" rows="4" class="form-control" placeholder="Descipcion..." readonly>{{ $ruta->descripcion }}</textarea>
                            </div>                              
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-0">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalAdd" href="#">Agregar municipio</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <td>Id</td> -->
                                            <th>Municipio</th>
                                            <th>Costo</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detalles as $i)
                                        <tr>
                                            <!-- <td>{{ $i->id }}</td> -->
                                            <td>{{ $i->municipio->nombre }}</td>
                                            <td>${{ $i->costo }}</td>
                                            <td class="w-25 text-center">
                                                <div class="btn-group">
                                                    <a href="#" data-toggle="modal" data-target="#exampleModalEdit" class="btnEditar btn btn-light" data-costo="{{ $i->costo }}" data-id="{{ $i->id }}" title="Editar"><i class="fas fa-pen-alt"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#exampleModalDelete{{ $i->id }}" class="btn btn-light" title="Eliminar"><i class="fas fa-trash"></i></a>
                                                </div>
                                                <form action="/rutas/eliminar/detalle/{{ $i->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal fade" id="exampleModalDelete{{ $i->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                            </div>
                                                            <div class="modal-body">
                                                                <h3 class="text-center">¿Eliminar registro?</h3>
                                                                <input type="hidden" name="ruta_id" value="{{ $ruta->id }}">
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
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('#rutas').addClass('active')
    $('.table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    })
    $('.btnEditar').click(function() {
        let id = $(this).attr('data-id')
        let costo = $(this).attr('data-costo')
        $('#detalle_id').val(id)
        $('#costo').val(costo)
    })
    $('.selectpicker').selectpicker()
    $('#departamento_id').change(function() {
        let departamentoId = $('#departamento_id').val();
        $.get('/rutas/municipios/departamento/'+departamentoId, function(data) {
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
