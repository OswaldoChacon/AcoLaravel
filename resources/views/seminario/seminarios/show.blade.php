@extends('seminario.seminarios.layout')

@section('contenido')
<div class="container-fluid">
	<h1>Número de Seminario: {{ $seminario->numeroSeminario }}</h1>
	<table class="table">
		<tr>
			<th>Título:</th>
			<td>{{ $seminario->titulo }}</td>
		</tr>
		<tr>
			<th>Periodo:</th>
			<td>{{ $seminario->periodo }}</td>
		</tr>
		<tr>
			<th>Año:</th>
			<td>{{ $seminario->anio }}</td>
		</tr>
		<tr>
			<th>Pertenece al FORO:</th>
			<td>{{ $seminario->foro_id}}</td>
		</tr>
	</table>

	<a href="{{ route('seminarios.index') }}" class="btn btn-success">Regresar</a>
	<a href="{{ route('seminarios.edit', $seminario->id) }}" class="btn btn-info">Editar</a>
	{{-- <h1><b>Información sobre el Seminario</b></h1>
	<br>
	<h4><p><b>Título:</b> {{ $seminario->titulo }}</p></h4>
	<h4><p><b>Número de Seminario:</b> {{ $seminario->numeroSeminario }}</p></h4>
	<h4><p><b>Periodo:</b> {{ $seminario->periodo }}</h4></p>
	<h4><p><b>Año:</b> {{ $seminario->anio }}</p></h4>

	<br> --}}
</div>
<br>
@endsection