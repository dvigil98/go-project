@extends('shared/template')
@section('contenido')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Clientes</span>
                        <span class="info-box-number">
                            {{ $numeroDeClientes }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-building"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Empresas</span>
                        <span class="info-box-number">
                            {{ $numeroDeEmpresas }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-store-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sucursales</span>
                        <span class="info-box-number">
                            {{ $numeroDeEmpresas }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-folder-open"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Solicitudes</span>
                        <span class="info-box-number">
                            {{ $numeroDeSolicitudes }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Solicitudes por mes</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart1" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Envios por mes</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('#dashboard').addClass('active')

    const meses = [
		'enero',
        'febrero',
        'marzo',
        'abril',
		'mayo',
        'junio',
        'julio',
        'agosto',
		'septiembre',
        'octubre',
        'noviembre',
        'diciembre'
	]
	const colores = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(75, 192, 192, 0.2)'
    ];
	
    let values1 = [];
	let legends1 = [];
	let colors1 = [];
    let datos1 = @json($numeroDeSolicitudesPorMes);
    
    let i = 0;
	datos1.forEach((d) => {
		legends1.push(meses[d.mes - 1]);
		values1.push(d.solicitudes);
		colors1.push(colores[i]);
		i++;
		if (i == 3)
			i = 0;
	})

    const ctx1 = document.getElementById('myChart1').getContext('2d');
    const myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: legends1,
            datasets: [{
                data: values1,
				backgroundColor: colors1
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
				yAxes: [{
					ticks: {
						beginAtZero: true
					},
                    gridLines: {
                        display:    false
                    }
				}]
			},
			legend: {
				display: false
			}
        }
    });

    let values2 = [];
	let legends2 = [];
	let colors2 = [];
    let datos2 = @json($numeroDeEnviosPorMes);
    
    let j = 0;
	datos2.forEach((d) => {
		legends2.push(meses[d.mes - 1]);
		values2.push(d.envios);
		colors2.push(colores[j]);
		j++;
		if (j == 3)
			j = 0;
	})

    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const myChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: legends2,
            datasets: [{
                data: values2,
				backgroundColor: colors2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
@endsection
