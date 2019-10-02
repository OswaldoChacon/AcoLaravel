<!DOCTYPE html>
<html lang="en">


<head>
<div class="container">		
	<title>Login Docente</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
<hr>
 <div class=" text-center">
<image align="left" src="{{asset('ittg.png')}}"style="idth:200px; height:100px;position:absolute; left:17%; top:30px;" >
<image align="left" src="{{asset('registro.png')}}"style="width:200px; height:100px;position:absolute; right:10%; top:30px;">
<div class=" text-center">
  <br>
  <h1>Instituto Tecnológico de Tuxtla Gutiérrez</h1>
  </image>
  <p>Ingenieria en sistemas computacionales</p> 

</div>
</div>

<div class="row ">
<div class="col-md-4 col-md-6" style="left: -5%" >
	<div class="list-group default">
		<div class="list-group-item panel panel-default ">
			<div class="panel panel-heading ">
				<h1 class="panel-title" >Operaciones de docente</h1>
			</div>
				<ul class="nav nav nav-tabs nav-stacked">
            	<?php if (Auth::guard('docentes')->user()->acceso==1): ?>
            		<a class="list-group-item"  href="{{route('registaralumno')}}">Registar Alumno</a>
            	<?php endif ?>	
				<a class="list-group-item"  href="{{route('notificacionesdocentes')}}">Notificaciones <span class="badge">{{$notificacione}}</span></a>
				<a class="list-group-item"  href="{{route('proyectosAsessorados')}}">Proyectos assesor</a>
				<a class="list-group-item"  href="{{ route('showprojects') }}">Proyectos como JURADO</a>
				<a class="list-group-item"  href="#">Seminario</a>
				<a class="list-group-item"  href="#">Proyectos</a>	
		</div>	
	</div>
</div>
</div>

<div  class="row" >
	<div class="col-md-4 col-md-6" style="left: -5%" >
		<div class="panel panel-default ">
			<div class="panel-heading ">
				<h1 class="panel-title" >Datos personales</h1>
			</div>

			<div class="panel-body">
				<strong>Usuario:</strong>{{ Auth::guard('docentes')->user()->nombre}}
			</div>
			<div class="panel-body">
				<strong>Email:</strong>{{ Auth::guard('docentes')->user()->email}}
			</div>
			<div class="panel-footer">
			<div class="panel-body">
				<a method="POTS" href="{{route('logoutDocente')}}">
					{{csrf_field()}}
					<button class="btn btn-danger btn-xs bnt-block">cerrar sesion</button>					
				</a>


				<a method="POTS" href="/editar/docente/{{Auth::guard('docentes')->user()->id}}">
					{{csrf_field()}}
					<button class="btn btn-primary btn-xs bnt-block">Editar</button>
				</a>	
			</div>
			</div>
		</div>	
	</div>
 </div>
</div>

<div  class="row" >
	<?php if (Auth::guard('docentes')->user()->acceso==1): ?>
			<div class="col-md-4 col-md-6"  style="right:-33%;top: -580px;width:65%;">
	<?php endif ?>
	<?php if (Auth::guard('docentes')->user()->acceso==0): ?>
			<div class="col-md-4 col-md-6"  style="right:-33%;top: -530px;width:65%;">
	<?php endif ?>
		<div class="panel panel-default ">
			 @yield('content') 
		</div>	
	</div>
</div>

</div>
</div>
</body>
</html>