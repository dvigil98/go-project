<!-- mensajes comunes -->
@if( session('msgType') && session('msg') )
    @switch (session('msgType'))
        @case('success')
        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
            <strong>EXITO!</strong> <p>{{ session('msg') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>        
        @break
        @case('danger')   
        <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
            <strong>UPS!</strong> <p>{{ session('msg') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>     
        @break
    @endswitch
@endif

<!-- mensajes de error de validacion -->
@if ($errors->any()) 
<div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
    <strong>UPS!</strong> <p>Llene los campos necesarios</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>   
@endif
