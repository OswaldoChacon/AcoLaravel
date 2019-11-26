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
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
	<!-- Jquery CDN -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</head>

<body>
	<div class="wrapper">
		<!-- Sidebar  -->
		<nav id="sidebar">
			<div class="sidebar-header">
			</div>
			<ul class="list-unstyled components">
				<li>
					<a href="{{route('registaralumno')}}">Registar Alumno</a>
				</li>
				<li>
					<!-- <a href="/registraProyecto">Registrar Poryecto</a> -->
					<a href="{{route('notificacionesdocentes')}}">Notificaciones <span class="badge"></span></a>
				</li>
				<li>
					<a href="{{route('proyectosAsessorados')}}">Proyectos como asesor</a>
				</li>
				<li>
					<!-- <a href="{{route('notificaciones')}}">Notificaciones</a> -->
					<a href="{{ route('showprojects') }}">Proyectos como JURADO</a>
                </li>
                <li>
					<!-- <a href="{{route('notificaciones')}}">Notificaciones</a> -->
					<a href="{{ route('horariogeneradoDocente') }}">Horario asignado del evento Foro</a>
				</li>
				<li>
					<!-- <a href="{{ route('dictamen') }}">Calificación del seminario</a> -->
					<a href="#">Seminario</a>
				</li>
				<li>
					<a href="#">Proyectos</a>
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
					<span style="color:#fff">Profesor de .......</span>
					<!-- Arreglar para el boton de usuario -->
					<button class="btn  d-print-inline-block d-lg-none ml-auto dropdown" type="button" data-toggle="dropdown" style="background: transparent !important; border:none;">
						<i class='fas fa-user' style='font-size:24px; color:#fff'></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" method="POTS" href="{{route('logoutDocente')}}">
							{{csrf_field()}}
							<i class="fas fa-sign-out-alt"></i><span>Cerrar sesion</span>
						</a>
						<a class="dropdown-item" method="POTS" href="/editar/docente/{{Crypt::encrypt(Auth::guard('docentes')->user()->id)}}">
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
							</li>
							<li class="nav-item d-none d-lg-block">
								<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" style="background: transparent !important; border:none;">
									<i class='fas fa-user' style='font-size:24px; color:#fff'></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" method="POTS" href="{{route('logoutDocente')}}">
										{{csrf_field()}}
										<i class="fas fa-sign-out-alt"></i><span>Cerrar sesion</span>
									</a>
									<a class="dropdown-item" method="POTS" href="/editar/docentes/{{Crypt::encrypt(Auth::guard('docentes')->user()->id)}}">
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
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> -->

	<script type="text/javascript">
		$(document).ready(function() {
			$('#sidebarCollapse').on('click', function() {
				$('#sidebar').toggleClass('active');
			});
		});
	</script>
</body>

</html>
