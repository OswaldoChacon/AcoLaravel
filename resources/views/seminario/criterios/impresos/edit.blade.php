@extends('seminario.criterios.impresos.layout')

@section('contenido')
	<div class="container-fluid">
		<h2><strong>Editar Criterio: <u>{{ $impreso->criterio }} </u></strong></h2>
		<br>
		@if (session()->has('info'))
			<div class="alert alert-success">{{ session('info') }}</div>
		@endif
		<form method="POST" action="{{ route('impresos.update', $impreso->id) }}">
			{!! method_field('PUT') !!}
			{!! csrf_field() !!}
			<h4><label for="criterio">
				Criterio:
				<input class="form-control" size="30" type="text" name="criterio" value="{{ $impreso->criterio }}" placeholder="Ingrese un nuevo criterio" required="required">
			</label></h4>
		
			<h4><label for="ponderacion">
				Ponderación:
				<input class="form-control" type="number" name="ponderacion" value="{{ $impreso->ponderacion }}" placeholder="Ingrese la ponderación">
			</label></h4>
			<br>
			<a class="btn btn-success" href="{{ route('impresos.index') }}">Regresar</a>
			<input class="btn btn-primary" type="submit" value="Actualizar">
		</form>
		<br>
	</div>
@endsection