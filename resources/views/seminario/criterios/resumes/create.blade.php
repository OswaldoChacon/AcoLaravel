@extends('seminario.criterios.resumes.layout')

@section('contenido')
<div class="card-header">
	<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('resumes.create') }}" role="tab" aria-controls="description" aria-selected="true">Crear criterios</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('resumes.index') }}" role="tab" aria-controls="description" aria-selected="true">Criterios de resumen</a>
		</li>

	</ul>
</div>
<div class="card-body">
	<h5 class="card-title">Dar de Alta Criterios de Resumen</h5>
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