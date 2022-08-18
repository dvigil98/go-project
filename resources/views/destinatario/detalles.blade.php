@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Destinatarios</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/destinatarios">Lista de destinatarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles de destinatario</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Form Modal agregar direccion -->
<form action="/direcciones/guardar" method="post">
    @csrf
    <div class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <div class="modal-body">
        <input type="hidden" name="destinatario_id" value="{{ $destinatario->id }}">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre...">
        </div>
        <div class="form-group">
            <label>Telefono</label>
            <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Telefono...">
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
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Form Modal editar direccion -->
<form action="/direcciones/actualizar" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <div class="modal-body">
        <input type="hidden" name="destinatario_id" value="{{ $destinatario->id }}">
        <input type="hidden" name="direccion_id" id="direccion_id">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre_e" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre...">
        </div>
        <div class="form-group">
            <label>Telefono</label>
            <input type="text" name="telefono" id="telefono_e" class="form-control @error('telefono') is-invalid @enderror" placeholder="Telefono...">
        </div>
        <div class="form-group">
            <label>Direccion</label>
            <input type="text" name="direccion" id="direccion_e" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion...">
        </div>
        <div class="form-group">
            <label>Departamento</label>
            <select name="departamento_id" id="departamento_id_e" class="form-control @error('departamento_id') is-invalid @enderror selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                @foreach($departamentos as $i)
                <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                @endforeach
            </select>
        </div>                              
        <div class="form-group">
            <label>Municipio</label>
            <select name="municipio_id" id="municipio_id_ee" class="form-control @error('municipio_id') is-invalid @enderror selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
            </select>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="#" method="post">
                    @csrf                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $destinatario->nombre }}" readonly>
                                    </div>       
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido..." value="{{ $destinatario->apellido }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono..." value="{{ $destinatario->telefono }}" readonly>
                                    </div>                                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DUI</label>
                                        <input type="text" name="dui" id="dui" class="form-control" placeholder="DUI..." value="{{ $destinatario->dui }}" readonly>
                                    </div>                                                    
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email..." value="{{ $destinatario->email }}" readonly>
                                    </div>      
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Cliente..." value="{{ $destinatario->cliente->nombre }} {{ $destinatario->cliente->apellido }}" readonly>
                                    </div>                                                      
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0 d-flex align-items-center">
                        <h3 class="card-title">Lista de direcciones</h3>
                        <a href="#" data-toggle="modal" data-target="#exampleModalAdd" class="ml-auto btn btn-primary">Agregar direccion</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>Id</th> -->
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($direcciones as $i)
                                    <tr>
                                        <!-- <td>{{ $i->id }}</td> -->
                                        <td>{{ $i->nombre }}</td>
                                        <td>{{ $i->telefono }}</td>
                                        <td>{{ $i->direccion }}, {{ $i->municipio->nombre }}, {{ $i->municipio->departamento->nombre }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#" data-toggle="modal" data-target="#exampleModalEdit" class="btnEditar btn btn-light" title="Editar"
                                                data-id="{{ $i->id }}"
                                                data-nombre="{{ $i->nombre }}"
                                                data-telefono="{{ $i->telefono }}"
                                                data-direccion="{{ $i->direccion }}"
                                                data-municipio_id="{{ $i->municipio_id }}"
                                                data-departamento_id="{{ $i->municipio->departamento->id }}">
                                                    <i class="fas fa-pen-alt"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#exampleModal{{ $i->id }}" class="btn btn-light" title="Eliminar"><i class="fas fa-trash"></i></a>
                                            </div>
                                            <form action="/direcciones/eliminar/{{ $i->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="exampleModal{{ $i->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="destinatario_id" value="{{ $destinatario->id }}">
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
    $('#destinatarios').addClass('active')
    $('.table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
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
    $('#departamento_id_e').change(function() {
       cargarMunicipios();
    })
    $('.btnEditar').click(function() {
        let id = $(this).attr('data-id');
        let nombre = $(this).attr('data-nombre');
        let telefono = $(this).attr('data-telefono');
        let direccion = $(this).attr('data-direccion');
        let municipio = $(this).attr('data-municipio_id');
        let departamento = $(this).attr('data-departamento_id');

        $('#direccion_id').val(id);
        $('#nombre_e').val(nombre);
        $('#telefono_e').val(telefono);
        $('#direccion_e').val(direccion);
        $('#departamento_id_e').val(departamento).change();
        
        cargarMunicipios(municipio)
        // $('#municipio_id_ee').val(municipio).change();
        // $('.selectpicker').selectpicker('refresh')
    })
    function cargarMunicipios(mid) {
        let departamentoId = $('#departamento_id_e').val();
        $.get('/rutas/municipios/departamento/'+departamentoId, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}">${d.nombre}</option>`
            })
            $('#municipio_id_ee').html(opt)
            $('#municipio_id_ee').val(mid).change()

            $('.selectpicker').selectpicker('refresh')
        })
    }
</script>
@endsection
