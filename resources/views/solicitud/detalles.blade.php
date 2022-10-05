@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Departamentos</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/solicitudes">Lista de solicitudes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles de solicitud</li>
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
                        <div class="card-header border-0">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Cambiar estado
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @foreach($estados as $i)
                                            <a class="dropdown-item" href="/solicitudes/cambiar-estado/{{ $solicitud->id }}/{{ $i->id }}">{{ $i->nombre }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripcion..." rows="4" readonly>{{ $solicitud->descripcion }}</textarea>
                                    </div>                              
                                    <div class="form-group">
                                        <label>Observacion</label>
                                        <textarea name="observacion" id="observacion" class="form-control @error('observacion') is-invalid @enderror" placeholder="Observacion..." rows="4" readonly>{{ $solicitud->observacion }}</textarea>
                                    </div>           
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value="{{ $solicitud->direccionDestinatario->destinatario->cliente->nombre }} {{ $solicitud->direccionDestinatario->destinatario->cliente->apellido }}">
                                    </div>      
                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value="{{ $solicitud->sucursal->empresa->razon_social }}">
                                    </div>                                                                              
                                    <div class="form-group">
                                        <label>Sucursal</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value="{{ $solicitud->sucursal->nombre }}">
                                    </div>                                                                              
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value="{{ $solicitud->sucursal->direccion }}, {{ $solicitud->sucursal->municipio->nombre }}, {{ $solicitud->sucursal->municipio->departamento->nombre }}">
                                    </div>                                                                              
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Destinatario</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value="{{ $solicitud->direccionDestinatario->destinatario->nombre }} {{ $solicitud->direccionDestinatario->destinatario->apellido }}">
                                    </div>                                                                              
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value="{{ $solicitud->direccionDestinatario->direccion }}, {{ $solicitud->direccionDestinatario->municipio->nombre }}, {{ $solicitud->direccionDestinatario->municipio->departamento->nombre }}">
                                    </div>     
                                    <div class="form-group">
                                        <label>Costo($)</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value="${{ $solicitud->costo }}">
                                    </div>      
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" name="costo" id="costo" class="form-control" placeholder="Costo..." readonly value=" @if($solicitud->estado_id == 1) Notificado @elseif($solicitud->estado_id == 2) Recolectado @elseif($solicitud->estado_id == 3) Enviado  @elseif($solicitud->estado_id == 4) Entregado  @else Devuelto a bodega @endif ">
                                    </div>                                                                             
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                    </div>
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
    $('#solicitudes').addClass('active')
</script>
@endsection
