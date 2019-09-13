@extends('seminario.criterios.impresos.layout')

@section('contenido')
<div class="card">
	<div class="card-header">
		<h5>Dar de Alta Criterios del Documento Impreso</h5>
	</div>
	<div class="card-body">
		<br>
		<form class="form-inline" method="POST" action="{{ route('impresos.store') }}">
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
</div>

@endsection