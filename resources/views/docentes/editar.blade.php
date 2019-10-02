@extends('docentes.docente')

@section('content')
<form method="post" action="/guardar/docente/{{$docente->id}}" class="form-center">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name">Usuario</label>
		<input class="form-control" type="text" name="name" value={{ $docente->name }}>
		{!! $errors->first('name','<span class="help-block alert alert-danger">:message</span>')!!}

		<label for="name">Correo</label>
		<input class="form-control" type="email" name="email" value={{ $docente->email }}>
		{!! $errors->first('email','<span class="help-block alert alert-danger">:message</span>')!!}


		<label for="name">Nombre</label>
		<input class="form-control" type="text" name="nombre" value={{ $docente->nombre }}>
		{!! $errors->first('nombre','<span class="help-block alert alert-danger">:message</span>')!!}


		<label for="name">Apellido Paterno</label>
		<input class="form-control" type="text" name="paterno" value={{ $docente->paterno }}>
		{!! $errors->first('paterno','<span class="help-block alert alert-danger">:message</span>')!!}

		<label for="name">Apellido Materno</label>
		<input class="form-control" type="text" name="materno" value={{ $docente->materno }}>
		{!! $errors->first('materno','<span class="help-block alert alert-danger">:message</span>')!!}


		<label for="name">Prefijo</label>
		<input class="form-control" type="text" name="prefijo" value={{ $docente->prefijo }}>
		{!! $errors->first('prefijo','<span class="help-block alert alert-danger">:message</span>')!!}


		<label for="password">Contraseña</label>
		<input class="form-control" type="password" name="password" value={{ $docente->passsword}}>
		{!! $errors->first('password','<span class="help-block alert alert-danger">:message</span>')!!}
	</div>
	<button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>

</form>

@endsection