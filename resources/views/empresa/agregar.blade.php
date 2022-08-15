@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Empresas</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/empresas">Lista de empresas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agregar empresa</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/empresas/guardar" method="post">
                    @csrf                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Razon social</label>
                                        <input type="text" name="razon_social" id="razon_social" class="form-control @error('razon_social') is-invalid @enderror" placeholder="Razon social...">
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
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                            <a href="/empresas" class="btn btn-light">Cancelar</a>
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
    $('#empresas').addClass('active')
    $('.selectpicker').selectpicker()
</script>
@endsection
