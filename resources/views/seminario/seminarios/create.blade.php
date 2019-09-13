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
	<br>
	<br>
	{{-- @endif --}}
	<form class="form-inline" method="POST" action="{{ route('seminarios.store') }}">
		{!! csrf_field() !!}
		<label for="titulo">
			Título:
			<input class="form-control" size="60" type="text" name="titulo" value="SEMINARIO DE INVESTIGACIÓN EN SISTEMAS COMPUTACIONALES">
			{!! $errors->first('titulo','<span class=error>:message</span>') !!}
		</label>
		<br>
		<label for="numeroSeminario">
			N° Seminario:
			<input class="form-control" type="number" name="numeroSeminario" value="{{ old('numeroSeminario') }}" placeholder="Ingrese el N° Seminario">
			{!! $errors->first('numeroSeminario','<span class=error>:message</span>') !!}
		</label>
		<br>
		<label>
			Periodo:
			<select class="form-control" name="periodo">
				<option disabled selected>Periodo</option>
				<option value="Enero-Junio">Enero-Junio</option>
				<option value="Agosto-Diciembre">Agosto-Diciembre</option>
			</select>
			{!! $errors->first('periodo', '<span class=error>:message</span>') !!}
		</label>
		<br>
		<label>
			Año:
			<select class="form-control" name="anio">
				<option disabled selected>Año</option>
				@foreach (range(2018,2050) as $a)
				<option value="{{$a}}">{{$a}}</option>
				@endforeach
			</select>
			{!! $errors->first('anio', '<span class=error>:message</span>') !!}
		</label>
		<br>
		<label>
			Seleccione el Foro al que pertenece el Seminario:
			<select class="form-control" name="foro_id">
				<option disabled selected>Foro</option>
				@foreach ($foros as $id => $foro_id)
				<option>{{ $foro_id }}</option>
				@endforeach
			</select>
			{!! $errors->first('foro_id', '<span class=error>:message</span>') !!}
		</label>
		<br><br>
		<input class="btn btn-primary" type="submit" value="Guardar">
	</form>
</div>


<div class="container">

</div>

@endsection