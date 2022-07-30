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
                    <li class="breadcrumb-item active" aria-current="page">Agregar ruta</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="/rutas/guardar" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre...">
                            </div>                              
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea name="descripcion" id="descripcion" rows="4" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descipcion..."></textarea>
                            </div>                              
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select name="b_departamento_id" id="b_departamento_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Seleccione</option>
                                    @foreach($departamentos as $i)
                                    <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>                              
                            <div class="form-group">
                                <label>Municipio</label>
                                <select name="b_municipio_id" id="b_municipio_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>                              
                            <div class="form-group">
                                <label>Costo</label>
                                <input type="number" name="b_costo" id="b_costo" class="form-control" placeholder="Costo...">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-light form-control" id="btnAdd">
                                    Agregar
                                </button>
                            </div>                              
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Municipio</th>
                                            <th>Costo</th>
                                            <th class="text-center">Acciones</th>
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
                                <a href="/rutas" class="btn btn-light">Cancelar</a>
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
    $('#rutas').addClass('active')
    $('.selectpicker').selectpicker()
    $('#b_departamento_id').change(function() {
        let departamentoId = $('#b_departamento_id').val();
        $.get('/rutas/municipios/departamento/'+departamentoId, function(data) {
            let opt = '<option value="">Seleccione</option>'
            data.forEach(d => {
                opt += `<option value="${d.id}">${d.nombre}</option>`
            })
            $('#b_municipio_id').html(opt)
            $('.selectpicker').selectpicker('refresh')
        })
    })
    $('#guardar').hide()
    let cont = 0
    $('#btnAdd').click(function() {
        let idMunicipio = $('#b_municipio_id').val()
        let municipio = $('#b_municipio_id option:selected').text()
        let costo = parseFloat($('#b_costo').val())
        console.log(idMunicipio, municipio, costo);
        if (idMunicipio != '' && costo >= 0) {	    
            let fila = '<tr class="selected" id="fila'+cont+'">'
            fila += '<td><input type="hidden" name="idMunicipio[]" value="'+idMunicipio+'"/>'+municipio+'</td>'
            fila += '<td><input type="hidden" name="costo[]" value="'+costo+'"/>$'+costo+'</td>'
            fila += '<td class="text-center"><button type="button" class="btn btn-light" onclick="eliminar('+cont+')" title="Eliminar"><i class="fas fa-trash"></i></button></td>'
            fila += '</tr>'
            cont++
            $('#data').append(fila)
            limpiar()
            evaluar()
        }
    });
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
