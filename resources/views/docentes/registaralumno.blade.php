@extends('docentes.docente')

@section('content')
	 @if (Session::has('message'))
		<div class="alert alert alert-info">{{ Session::get('message') }}</div>
			@endif
  <div class="panel-heading">Token a crear para Alumno </div>
  <div class="panel-body">
    <form  method="post" action="{{ route('profes') }}" class="form-center ">
			 	{{csrf_field()}}
				<div class="form-group ">
					
					<input class="form-control" 
					type="number" 
					name="tokenN" 
					placeholder="Cuantos Token desea">
				</div>
				<button type="submit" class="btn btn-primary" value="Registrar" name="">Acceder</button>
				{!! $errors->first('tokenN','<span class="help-block alert alert-danger">:message</span>')!!}
   </form>
</div>
@endsection
