@extends('seminario.criterios.impresos.layout')

@section('contenido')
<div class="card-header">
	<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('impresos.create') }}" role="tab" aria-controls="description" aria-selected="true">Crear criterios</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('impresos.index') }}" role="tab" aria-controls="history" aria-selected="false">Criterios del documento impreso</a>
		</li>
	</ul>
</div>

<div class="card-body">
	<h5 class="card-title">Dar de Alta Criterios del Documento Impreso</h5>
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