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
                    <li class="breadcrumb-item active" aria-current="page">Detalles de usuario</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="#" method="post">
                    @csrf                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{ $user->nombre }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email..." value="{{ $user->email }}" readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña..." readonly>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <input type="text" name="rol" id="rol" class="form-control" placeholder="Rol..." value="{{ $user->rol->nombre }}" readonly>
                                    </div>                              
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" name="activo" id="activo" class="form-control" placeholder="Estado..." value="@if( $user->activo == 1) Activo @else Inactivo @endif" readonly>
                                    </div>                              
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
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
</script>
@endsection
