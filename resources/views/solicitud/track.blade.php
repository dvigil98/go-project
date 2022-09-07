<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Track Package</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand m-auto" href="#">Go Project</a>
        </div>
    </nav>
    <div class="container py-4">
        <h1 class="display-1 text-center fw-bold">Rastrea tu paquete</h1>
    </div>
    <div class="container mb-5">
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" id="codigo" class="form-control" placeholder="Type your code">
                </div>
            </div>
            <div class="col-md-2">
                <button id="btnVerificar" class="btn btn-info form-control" type="button">Verificar</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="track">
    
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-header bg-white">
                            Detalles del envio
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12 col-md-3 text-">
                                    <p class="m-0 text-muted">Codigo</p>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <p>ENV1001SV</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 text-">
                                    <p class="m-0 text-muted">Receptor</p>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <p>Juan Villalta</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 text-">
                                    <p class="m-0 text-muted">Direccion</p>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <p>Col. Morazan, 4to pje. #74, San Fco. Gotera, Morazan</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 text-">
                                    <p class="m-0 text-muted">Descripcion</p>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad facere quos cum iste?</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 text-">
                                    <p class="m-0 text-muted">Observacion</p>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <p>Llevar con cuidado, es fragil</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="card">
                        <div class="card-header bg-white">
                            Historial de movimientos
                        </div>
                        <div class="card-body px-1">

                            <ul class="list-group list-group-flush" id="historial">
                            </ul>

    
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        $('#btnVerificar').click(function(e) {
            e.preventDefault()
            let codigopre = $('#codigo').val().split('ENV')
            let codigosu = codigopre[1].split('SV')
            console.log(codigosu);
            $.get('/obtener-historial/'+parseInt(codigosu[0]), function(data) {
                console.log(data);
                let li = '';
                data.forEach(d => {
                    li += `
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <p class="m-0 text-muted">Fecha</p>
                                <p class="m-0">${new Intl.DateTimeFormat('es-SV', {}).format(new Date(d.fecha))}</p>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <p class="m-0 text-muted">Estado</p>
                                <p class="m-0">${d.nombre}</p>
                            </div>
                        </div>
                    </li>
                    `
                })
                $('#historial').html(li)
            })
            $.get('/obtener-solicitud/'+parseInt(codigosu[0]), function(data) {
                console.log(data);
            })
        })
    </script>
    <br>
    <br>
</body>
</html>
