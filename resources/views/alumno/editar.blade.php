@extends('alumno.alumno')

@section('content')
<div class="card">
	<h5 class="card-header">Mis datos personales</h5>

	<div class="card-body">
		<form method="post" action="/guardar/alumno/{{Crypt::encrypt($alumno->id)}}" class="form-center">
			{{csrf_field()}}
			<div class="form-group">
				<label for="name">Usuario</label>
				<input class="form-control" type="text" name="name" value={{ $alumno->name }}>
				{!! $errors->first('name','<span class="help-block alert alert-danger">:message</span>')!!}

				<label for="name">Correo</label>
				<input class="form-control" type="email" name="email" value={{ $alumno->email }}>
				{!! $errors->first('email','<span class="help-block alert alert-danger">:message</span>')!!}


				<label for="name">Nombre</label>
				<input class="form-control" type="text" name="nombre" value={{ $alumno->nombre }}>
				{!! $errors->first('nombre','<span class="help-block alert alert-danger">:message</span>')!!}


				<label for="name">Apellido Paterno</label>
				<input class="form-control" type="text" name="paterno" value={{ $alumno->paterno }}>
				{!! $errors->first('paterno','<span class="help-block alert alert-danger">:message</span>')!!}

				<label for="name">Apellido Materno</label>
				<input class="form-control" type="text" name="materno" value={{ $alumno->materno }}>
				{!! $errors->first('materno','<span class="help-block alert alert-danger">:message</span>')!!}



				<label for="password">Contraseña</label>
				<input class="form-control" type="password" name="password" value={{ $alumno->passsword}}>
				{!! $errors->first('password','<span class="help-block alert alert-danger">:message</span>')!!}
			</div>
			<button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>

		</form>
	</div>
</div>


@endsection