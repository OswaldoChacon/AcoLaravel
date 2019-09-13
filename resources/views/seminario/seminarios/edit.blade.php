@extends('seminario.seminarios.layout')

@section('contenido')
<div class="container-fluid">
	<h1><strong>Editar Seminario: <u>{{ $seminario->numeroSeminario }} </u></strong></h1>
	<br>
	@if (session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
	@endif
	<form method="POST" action="{{ route('seminarios.update', $seminario->id) }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<h4><label for="titulo">
			Título:
			<input class="form-control" size="60" type="text" name="titulo" value="SEMINARIO DE INVESTIGACIÓN EN SISTEMAS COMPUTACIONALES">
			{!! $errors->first('titulo','<span class=error>:message</span>') !!}
		</label></h4>
		<h4><label for="numeroSeminario">
			N° Seminario:
			<input class="form-control" type="number" name="numeroSeminario" value="{{ $seminario->numeroSeminario }}" placeholder="Ingrese el N° Seminario">
			{!! $errors->first('numeroSeminario','<span class=error>:message</span>') !!}
		</label></h4>
		<h4><label for="periodo">
			Periodo:
			<select class="form-control" name="periodo">
				<option disabled selected>Periodo</option>
				<option value="Enero-Junio">Enero-Junio</option>
				<option value="Agosto-Diciembre">Agosto-Diciembre</option>
			</select>	
			{!! $errors->first('periodo', '<span class=error>:message</span>') !!}
		</label></h4>
		<h4><label for="anio">
			Año:
			<select class="form-control" name="anio">
				<option disabled selected>Año</option>
	            @foreach (range(2018,2050) as $a)
	            	<option value="{{$a}}">{{$a}}</option>
	            @endforeach 
	 	 	</select>
	 	 	{!! $errors->first('anio', '<span class=error>:message</span>') !!}
		</label></h4>
		<br>
		{{-- <h4><label class="form-inline">
			Seleccione el Foro al que pertenece el Seminario:
			<select class="form-control" name="foro_id">
				<option disabled selected>Foro</option>
				@foreach ($seminarios as $seminario)
					<option>{{ $seminario->foro_id}}</option>
				@endforeach
			</select>
			{!! $errors->first('foro_id', '<span class=error>:message</span>') !!}
		</label></h4>
		<br> --}}
		<a href="{{ route('seminarios.index')}}" class="btn btn-success">Regresar</a>
		<input class="btn btn-primary" type="submit" value="Actualizar">						
	</form>
	<br>
</div>
@endsection