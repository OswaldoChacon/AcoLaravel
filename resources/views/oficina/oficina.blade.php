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
</head>

<body>
	<div class="loaderContainer">
		<div class="loader"></div>
	</div>
	<div class="messageContainer">
		<div class="message">
			<div class="icon">
				<i class="fas fa-envelope"></i>
			</div>
			<div class="title">
				<p></p>
			</div>
			<div class="description">
				<p></p>
			</div>
		</div>
	</div>
	<div class="wrapper">
		<!-- Sidebar  -->
		<nav id="sidebar">
			<div class="sidebar-header">
			</div>
			<ul class="list-unstyled components">
				<li>
					<a href="{{route('oficina')}}"> Inicio</a>
				</li>
				<li>
					<a href="{{route('lineaDeInvetigacion')}}">Linea de investigación</a>
				</li>
				<li>
					<a href="{{route('tokenProfe')}}">Registrar token para docentes</a>
				</li>
				<li>
					<a href="{{route('tokenAlumno')}}">Registrar token para alumnos</a>
				</li>
				<!-- <li> -->
				<li class="active">
					<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Foros</a>
					<ul class="collapse list-unstyled" id="homeSubmenu">
						<li>
							<a href="{{route('crearForo')}}">Crear Foros</a>
						</li>
						<li>
							<a href="{{route('foros')}}">Foros</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#menuhorarios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Horarios</a>
					<ul class="collapse list-unstyled" id="menuhorarios">
						<li>
							<a href="/horarios">Proyectos registrados</a>
						</li>
						<li>
							<a href="/addHour">Asignar horario del jurado</a>
						</li>
						<li>
							<a href="/proyectosJurado">Proyectos participantes</a>
						</li>
						<li>
							<a href="/generarHorario">Generar horario</a>
						</li>						
					</ul>
				</li>
				<li>
					<a href="{{route('alumnos')}}">Alumnos</a>
				</li>
				<li>
					<a href="{{route('profes')}}">Docentes</a>
				</li>
				<li>
					<a href="{{ route('seminarios.create') }}">Seminario</a>
				</li>
				<li>
					<a href="{{ route('juradosprojects') }}">Asignar jurado</a>
				</li>
				<li>
					<a href="{{ route('criterios') }}">Asignar criterios</a>
				</li>
			{{-- 	<li>
					<a href="{{ route('sheets') }}">Hojas de evaluaciones del seminario</a>
				</li> --}}

				<li>
					<a href="{{route('juradosprojects2')}}">Segumiento De Proyectos</a>
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
					<span style="color:#fff">Oficina de .......</span>
					<!-- Arreglar para el boton de usuario -->
					<!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class='fas fa-user' style='font-size:24px; color:#fff'></i>

					</button> -->
					<button class="btn  d-print-inline-block d-lg-none ml-auto dropdown" type="button" data-toggle="dropdown" style="background: transparent !important; border:none;">
						<i class='fas fa-user' style='font-size:24px; color:#fff'></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" method="POTS" href="{{route('logout')}}">
							{{csrf_field()}}
							<i class="fas fa-sign-out-alt"></i><span>Cerrar sesion</span>
						</a>
						<a class="dropdown-item" method="POST" href="/editar/{{Crypt::encrypt(auth()->user()->id)}}">
							{{csrf_field()}}
							<i class="far fa-edit"></i><span>Editar</span>
						</a>
					</div>
					<!--  -->
					<!--  -->
					<!--  -->
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
									<a class="dropdown-item" method="POTS" href="{{route('logout')}}">
										{{csrf_field()}}
										<i class="fas fa-sign-out-alt"></i><span>cerrar sesion</span>
									</a>
									<a class="dropdown-item" method="POST" href="/editar/{{Crypt::encrypt(auth()->user()->id)}}">
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
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="{{asset('js/all.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#sidebarCollapse').on('click', function() {
				$('#sidebar').toggleClass('active');
			});
		});
	</script>
	@stack('generarHorario')
	@stack('srcProfesores')
	@stack('participaControl')
    @stack('proyectos')
    @stack('asignarHorarioJurado')
    @stack('asignarHorarioBreak')

</body>

</html>
