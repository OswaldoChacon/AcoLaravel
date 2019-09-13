@extends('oficina.oficina')

@section('content')

	<div class="panel-heading">
    	<h3><center><b>Información del PROYECTO</b></center></h3>
  	</div>

  	<div class="container-fluid">
  	<table class="table">
  		@foreach($hoja->proyectosforos as $proyecto)
			<tr>
				<th>Título:</th>
				<td>{{ $proyecto->titulo }}</td>
			</tr>
			<tr>
				<th>Objetivo:</th>
				<td>{{ $proyecto->objetivo }}</td>
			</tr>
			<tr>
				<th>Línea:</th>
				<td>{{ $proyecto->linea }}</td>
			</tr>
			<tr>
				<th>Área:</th>
				<td>{{ $proyecto->area }}</td>
			</tr>
			<tr>
				<th>Nombre de la Empresa:</th>
				<td>{{ $proyecto->nombre_de_empresa }}</td>
			</tr>
			<tr>
				<th>Calificación del FORO:</th>
				<td><b>{{ $proyecto->calificacion }}</b></td>
			</tr>
			<tr>
				<th>Calificación del SEMINARIO:</th>
				<td><b>{{ $hoja->calificacion }}</b></td>
			</tr>
			<tr>
				<th>Observaciones:</th>
				<td>{{ $hoja->observaciones }}</td>
			</tr>
		@endforeach	
		<tr>
			<th>Evaluado por:</th>
			<td>
				@foreach($hoja->docentes as $docente)
					{{ $docente->prefijo }} {{ $docente->nombre }} {{ $docente->paterno }} {{ $docente->materno}}
				@endforeach
			</td>
		</tr>
	</table>

		<a href="{{ route('sheets') }}" class="btn btn-success">Regresar</a>
  	</div>
  	<br>
@endsection