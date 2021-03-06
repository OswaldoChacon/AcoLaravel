<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('img/favicon-32x32.png')}}">
	<title>Departamento de proyectos de investigación</title>

	<!-- Bootstrap CSS CDN -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Our Custom CSS	 -->
	<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<!-- Bootstrap JS CDN -->

</head>

<body>
	<div class="wrapper">
		<!-- Sidebar  -->
		<nav id="sidebar">
			<div class="sidebar-header">
			</div>
			<ul class="list-unstyled components">
				<li>
					<a href="{{route('alumno')}}"> Inicio</a>
				</li>
				@if (Auth::guard('alumnos')->user()->id_proyecto==null)
				<li>
					<a href="/registraProyecto">Registrar Poryecto</a>
				</li>
				@endif
				<li>
					<a href="/proyectoAlumno/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">Proyecto</a>
				</li>
				<li>
					<a href="{{route('notificaciones')}}">Notificaciones</a>
				</li>
				<li>
					<a href="{{route('horariogeneradoAlumno')}}">Horario asignado para exponer</a>
				</li>
				<li>
					<a href="{{ route('dictamen') }}">Calificación del seminario</a>
				</li>

					@if (Auth::guard('alumnos')->user()->acceso==0)
                <li>
				<a  href="/EstadoDeProyectoAlumno/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">Estado de Proyecto</a>
					{{-- @endif --}}

					</li>



				@endif

				<li class="treeview">
				<a class="list-group-item" href="">Solicitar Cambios
				</a>
      <ul class="treeview-menu">

      <a class="list-group-item" href="/cambioNombre/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">Cambio de titulo</a>

	 <a class="list-group-item" href="/cambioAsesor/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">Cambio de asesor</a>
	 <a class="list-group-item" href="/cambioCancelacion/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">Cancelación de proyecto</a>
	<a class="list-group-item" href="/cambioBajaA/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">Baja de alumno</a>
												</ul>

				</li>

			</ul>



		</nav>

		<!-- Page Content  -->
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light fixed-top">
				<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="btn btn-default">
						<i class="fas fa-align-justify" style="color:#fff"></i>
					</button>
					<span style="color:#fff">Alumno de .......</span>
					<!-- Arreglar para el boton de usuario -->
					<button class="btn  d-print-inline-block d-lg-none ml-auto dropdown" type="button" data-toggle="dropdown" style="background: transparent !important; border:none;">
						<i class='fas fa-user' style='font-size:24px; color:#fff'></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" method="POTS" href="{{route('logoutAlumno')}}">
							{{csrf_field()}}
							<i class="fas fa-sign-out-alt"></i><span>Cerrar sesion</span>
						</a>
						<a class="dropdown-item" method="POTS" href="/editar/alumno/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
							{{csrf_field()}}
							<i class="far fa-edit"></i><span>Editar</span>
						</a>
					</div>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="nav navbar-nav ml-auto">
							<li class="nav-item active">
								<!-- <strong></strong>{{auth()->user()->name}} -->
								<!-- <strong>Email:</strong>{{auth()->user()->email}} -->
								<!-- <strong>nombre:</strong>{{auth()->user()->prefijo}} {{auth()->user()->nombre}} {{auth()->user()->paterno}} {{auth()->user()->materno}} -->
							</li>
							<li class="nav-item d-none d-lg-block">
								<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" style="background: transparent !important; border:none;">
									<i class='fas fa-user' style='font-size:24px; color:#fff'></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" method="POTS" href="{{route('logoutAlumno')}}">
										{{csrf_field()}}
										<i class="fas fa-sign-out-alt"></i><span>Cerrar sesion</span>
									</a>
									<a class="dropdown-item" method="POTS" href="/editar/alumno/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
										{{csrf_field()}}
										<i class="far fa-edit"></i><span>Editar</span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="content-layout">
				@yield('content')
			</div>
		</div>
	</div>
	<script src="{{asset('js/jquery.js')}}"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Jquery CDN -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#sidebarCollapse').on('click', function() {
				$('#sidebar').toggleClass('active');
			});
		});
	</script>
</body>

</html>
