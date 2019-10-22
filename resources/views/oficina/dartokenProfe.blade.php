@extends('oficina.oficina')

@section('content')
<div class="card">
	<h5 class="card-header">Token para docentes</h5>
	<div class="card-body">
		<form method="post" action="{{ route('dartokenProfe') }}" class="form-center">
			{{ csrf_field() }}
			@if (Session::has('message'))
			<div class="alert alert alert-danger">No.Control existentes: ({{ Session::get('message') }})</div>
			@endif
			@foreach (range(1,$tokenN) as $token)
			<div class="form-group">
				<label for="email-{{$token}}">Correo #{{$token}}</label>
				<input class="form-control" type="text" name="emails[]" id="email-{{$token}}" class="form-control" placeholder='Email'>
				{!! $errors->first('email','<span class="help-block alert alert-danger">:message</span>')!!}
			</div>
			@endforeach
			<button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>

		</form>
	</div>
</div>

@endsection