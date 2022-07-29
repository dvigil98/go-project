@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Usuarios</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/users">Lista de usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar usuario</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/users/actualizar/{{ $user->id }}" method="post">
                    @csrf                
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre..." value="{{ $user->nombre }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." value="{{ $user->email }}">
                                    </div>                              
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña...">
                                    </div>                              
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror selectpicker" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            @foreach($roles as $i)
                                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>                              
                                </div>
                                <div class="col-md-4">
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
                            <a href="/users" class="btn btn-light">Cancelar</a>
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
    $('#users').addClass('active')
    $('.selectpicker').selectpicker()
    $('#rol_id').val({{ $user->rol_id }}).change()
    $('#activo').val({{ $user->activo }}).change()
</script>
@endsection
