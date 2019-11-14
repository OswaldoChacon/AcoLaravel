@extends('seminario.seminarios.layout')

@section('contenido')
<div class="card-header">
	<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('seminarios.create') }}" role="tab" aria-controls="description" aria-selected="true">Crear seminario</a>
		</li>
		<li class="nav-item">
			<a class="nav-link " href="{{ route('seminarios.index') }}" role="tab" aria-controls="history" aria-selected="false">Ver seminarios</a>
		</li>
	</ul>
</div>
<div class="card-body">
	<h4> <strong> Dar de Alta Seminario</strong></h4>
	{{-- @if( session()->has('info') )
	<h3>{{ session('info') }}</h3>
	@else --}}

	{{-- @endif --}}
	<form method="POST" action="{{ route('seminarios.store') }}">
		{!! csrf_field() !!}
		<div class="form-group">
			<label for="titulo">Título:</label>
			<input class="form-control" size="60" type="text" name="titulo" value="SEMINARIO DE INVESTIGACIÓN EN SISTEMAS COMPUTACIONALES">
			{!! $errors->first('titulo','<span class="text-danger">:message</span>') !!}
		</div>
		<div class="form-group">
			<label for="numeroSeminario">N° Seminario:</label>
			<input class="form-control" type="number" name="numeroSeminario" value="{{ old('numeroSeminario') }}" placeholder="Ingrese el N° Seminario">
			{!! $errors->first('numeroSeminario','<span class="text-danger">:message</span>') !!}
		</div>
		<div class="form-group">
			<label>Periodo:</label>
			<select class="form-control" name="periodo">
				<option disabled selected>Periodo</option>
				<option value="Enero-Junio">Enero-Junio</option>
				<option value="Agosto-Diciembre">Agosto-Diciembre</option>
			</select>
			{!! $errors->first('periodo', '<span class="text-danger">:message</span>') !!}
		</div>
		<div class="form-group">
			<label>Año:</label>
			<select class="form-control" name="anio">
				<option disabled selected>Año</option>
				@foreach (range(2019,2050) as $a)
				<option value="{{$a}}">{{$a}}</option>
				@endforeach
			</select>
			{!! $errors->first('anio', '<span class="text-danger">:message</span>') !!}
		</div>
		<div class="form-group">
			<label>Seleccione el Foro al que pertenece el Seminario:</label>
			<select class="form-control" name="foro_id">
				<option disabled selected>Foro</option>
				@foreach ($foros as $id => $foro_id)
				<option>{{ $foro_id }}</option>
				@endforeach
			</select>
			{!! $errors->first('foro_id', '<span class="text-danger">:message</span>') !!}
		</div>

		<input class="btn btn-primary" type="submit" value="Guardar">
	</form>
</div>


<div class="container">

</div>

@endsection
