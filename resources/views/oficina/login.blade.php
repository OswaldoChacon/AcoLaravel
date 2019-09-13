@extends('layouts.app')
@include('layouts.principalBorde')

@section('content')
<div class="row" >
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Acceso a la Oficina</h1>
			</div>
			<div class="panel-body">
			 <form method="POST" action="{{route('login')}}">
			 	{{csrf_field()}}
				<div class="form-group {{ $errors->has('name')? 'has-error': ''}}">
					<label for="name">Usuario</label>
					<input class="form-control" 
					type="text" 
					name="name" 
					value="{{old('name')}}"
					placeholder="Usuario">
					{!! $errors->first('name','<span class="help-block">:message</span>')!!}
				</div>
				<div class="form-group {{ $errors->has('password')? 'has-error': ''}}">
					<label for="password">Contraseña</label>
					<input class="form-control" 
					type="password" 
					name="password" 
					placeholder="Contraseña">
					{!! $errors->first('password','<span class="help-block">:message</span>')!!}
				</div>
				<button class="btn-primary btn-block">Acceder</button>
			 </form>
			</div>
		</div>
	</div>
</div>
@include('layouts.footergeneral')
@endsection
