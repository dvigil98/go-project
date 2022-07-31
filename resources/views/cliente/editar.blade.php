@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Clientes</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/clientes">Lista de clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar cliente</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/clientes/actualizar/{{ $cliente->id }}" method="post">
                    @csrf                
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Razon social</label>
                                        <input type="text" name="razon_social" id="razon_social" class="form-control @error('razon_social') is-invalid @enderror" placeholder="Razon social..." value="{{ $cliente->razon_social }}">
                                    </div>         
                                    <div class="form-group">
                                        <label>Representante</label>
                                        <input type="text" name="representante" id="representante" class="form-control @error('representante') is-invalid @enderror" placeholder="Representante..." value="{{ $cliente->representante }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>DUI</label>
                                        <input type="text" name="dui" id="dui" class="form-control @error('dui') is-invalid @enderror" placeholder="DUI..." value="{{ $cliente->dui }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>NIT</label>
                                        <input type="text" name="nit" id="nit" class="form-control @error('nit') is-invalid @enderror" placeholder="NIT..." value="{{ $cliente->nit }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Telefono..." value="{{ $cliente->telefono }}">
                                    </div>                                                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." value="{{ $cliente->email }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña...">
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select name="activo" id="activo" class="form-control @error('activo') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
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
                            <a href="/clientes" class="btn btn-light">Cancelar</a>
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
    $('#clientes').addClass('active')
    $('.selectpicker').selectpicker()
    $('#activo').val({{ $cliente->activo }}).change()
</script>
@endsection
