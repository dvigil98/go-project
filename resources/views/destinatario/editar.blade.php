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
                    <li class="breadcrumb-item active" aria-current="page">Editar destinatario</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/destinatarios/actualizar/{{ $destinatario->id }}" method="post">
                    @csrf                
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre..." value="{{ $destinatario->nombre }}">
                                    </div>   
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" name="apellido" id="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido..." value="{{ $destinatario->apellido }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Telefono..." value="{{ $destinatario->telefono }}">
                                    </div>                             
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>DUI</label>
                                        <input type="text" name="dui" id="dui" class="form-control @error('dui') is-invalid @enderror" placeholder="DUI..." value="{{ $destinatario->dui }}">
                                    </div>                                                    
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." value="{{ $destinatario->email }}">
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
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                            <a href="/destinatarios" class="btn btn-light">Cancelar</a>
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
    $('#destinatarios').addClass('active')
    $('.selectpicker').selectpicker()
    $('#cliente_id').val({{ $destinatario->cliente_id }}).change()
</script>
@endsection
