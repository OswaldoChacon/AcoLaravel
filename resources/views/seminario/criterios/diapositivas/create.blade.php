@extends('seminario.criterios.diapositivas.layout')

@section('contenido')
	<div class="container-fluid">
		<h1><b>Dar de Alta Criterios de Exposición</b></h1>
		<br>
		<form class="form-inline" method="POST" action="{{ route('diapositivas.store') }}">
			{!! csrf_field() !!}
			<label for="criterio">
				Criterio:
				<input class="form-control" size="30" type="text" name="criterio" value="{{ old('criterio') }}" placeholder="Ingrese un nuevo criterio" required="required">
			</label>
			<br>
			<label for="ponderacion">
				Ponderación:
				<input class="form-control" type="number" name="ponderacion" value="{{ old('ponderacion') }}" placeholder="Ingrese la ponderación" required="required">
			</label>
			<br><br>
			<a class="btn btn-success" href="{{ route('criterios') }}">Regresar</a>
			<input class="btn btn-primary" type="submit" value="Guardar">
		</form>
		<br>
	</div>
@endsection