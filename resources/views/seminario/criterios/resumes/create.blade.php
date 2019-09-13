@extends('seminario.criterios.resumes.layout')

@section('contenido')
	<div class="container-fluid">
		<h1><b>Dar de Alta Criterios de Resumen</b></h1>
		<br>
		<form class="form-inline" method="POST" action="{{ route('resumes.store') }}">
			{!! csrf_field() !!}
			<label for="criterio">
				Criterio:
				<select class="form-control" name="criterio">
					<option disabled selected>Elija una Opción</option>
					<option>Documento Impreso</option>
					<option>Exposición de Diapositivas</option>
				</select>
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