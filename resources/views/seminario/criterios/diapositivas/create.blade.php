@extends('seminario.criterios.diapositivas.layout')

@section('contenido')
<div class="card-header">
	<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('diapositivas.create') }}" role="tab" aria-controls="description" aria-selected="true">Crear criterios</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('diapositivas.index') }}" role="tab" aria-controls="description" aria-selected="true">Criterios de diapositivas</a>
		</li>

	</ul>
</div>
<div class="card-body">
	<h5 class="card-title">Dar de alta criterios de diapositivas</h5>
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