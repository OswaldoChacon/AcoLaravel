@extends('oficina.oficina')

@section('content')

<div class="panel-heading">Editar informacion </div>
<div class="panel-body">

	<form method="post" action="/guardar/{{$user->id}}" class="form-center">
		{{csrf_field()}}
		<div class="form-group">
			<label for="name">Usuario</label>
			<input class="form-control" type="text" name="name" value="{{ $user->name }}">
			{!! $errors->first('name','<span class="help-block alert alert-danger">:message</span>')!!}

			<label for="name">Correo</label>
			<input class="form-control" type="email" name="email" value={{ $user->email }}>
			{!! $errors->first('email','<span class="help-block alert alert-danger">:message</span>')!!}


			<label for="name">Nombre</label>
			<input class="form-control" type="text" name="nombre" value="{{ $user->nombre }}">
			{!! $errors->first('nombre','<span class="help-block alert alert-danger">:message</span>')!!}


			<label for="name">Apellido Paterno</label>
			<input class="form-control" type="text" name="paterno" value={{ $user->paterno }}>
			{!! $errors->first('paterno','<span class="help-block alert alert-danger">:message</span>')!!}

			<label for="name">Apellido Materno</label>
			<input class="form-control" type="text" name="materno" value={{ $user->materno }}>
			{!! $errors->first('materno','<span class="help-block alert alert-danger">:message</span>')!!}


			<label for="name">Prefijo</label>
			<input class="form-control" type="text" name="prefijo" value={{ $user->prefijo }}>
			{!! $errors->first('prefijo','<span class="help-block alert alert-danger">:message</span>')!!}


			<label for="password">Contraseña</label>
			<input class="form-control" type="password" name="password" value={{ $user->passsword }}>
			{!! $errors->first('password','<span class="help-block alert alert-danger">:message</span>')!!}
		</div>
		<button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>

	</form>
</div>

@endsection