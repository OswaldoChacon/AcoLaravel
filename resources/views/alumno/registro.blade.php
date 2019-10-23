@extends('layouts.app')
@include('layouts.principalBorde')

@section('content')
<div class="row" >
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Acceso de Alumno</h1>
				<ul class="pager nav navbar-nav navbar-right" style="position: absolute; top:-16px; left: 611px;">
  					<li><a href="{{ route('loginAlumno') }}">Login</a></li>
  					<li ><a href="{{ route('registroAlumno') }}">Registro</a></li>
				</ul>
			</div>
     <div class="panel-body">
			 
			 <form  method="post" action=" {{route('guardarAlumno')}}" class="form-center">
			 	{{csrf_field()}}
				<div class="form-group">
					<label for="name">Numero de control</label>
					<input class="form-control" 
					type="text" 
					name="nocontro" 
					placeholder = ' numero de control' >
					{!! $errors->first('nocontro','<span class="help-block alert alert-danger">:message</span>')!!}

				

					<label for="name">Usuario</label>
					<input class="form-control" 
					type="text" 
					name="name_usuario" 
					placeholder = 'Usuario' >
					{!! $errors->first('name_usuario','<span class="help-block alert alert-danger">:message</span>')!!}

					<label for="email">Correo</label>
					<input class="form-control" 
					type="email" 
					name="email" 
					placeholder='Email'>
					{!! $errors->first('email','<span class="help-block alert alert-danger">:message</span>')!!}


					<label for="email">Nombre</label>
					<input class="form-control" 
					type="text" 
					name="nombre" 
					placeholder='Nombre'>
					{!! $errors->first('nombre','<span class="help-block alert alert-danger">:message</span>')!!}


					<label for="email">Apellido Paterno</label>
					<input class="form-control" 
					type="text" 
					name="paterno" 
					placeholder='Apellido paterno'>
					{!! $errors->first('paterno','<span class="help-block alert alert-danger">:message</span>')!!}

					<label for="email">Apellido Materno</label>
					<input class="form-control" 
					type="text" 
					name="materno" 
					placeholder='Apellido materno'>
					{!! $errors->first('materno','<span class="help-block alert alert-danger">:message</span>')!!}


					<label for="password">Contraseña</label>
					<input class="form-control" 
					type="password" 
					name="password" 
					placeholder='Contraseña'>
					{!! $errors->first('password','<span class="help-block alert alert-danger">:message</span>')!!}
				</div>
				<button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>

                </form>
    </div>
</div>
@include('layouts.footergeneral')
@endsection
