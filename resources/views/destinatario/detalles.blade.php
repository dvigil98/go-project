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
                                <div class="col-md-4">
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
    $('#destinatarios').addClass('active')
</script>
@endsection
