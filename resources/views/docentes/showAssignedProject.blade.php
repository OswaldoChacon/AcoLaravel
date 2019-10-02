@extends('docentes.docente')

@section('content')
	<div class="panel-heading">
    	<h3><center><b>Proyecto a EVALUAR</b></center></h3>
  	</div>

  	<div class="container-fluid">
  	<form method="POST" action="{{ route('CreateEvaluateProject', $proyecto->id) }}">
	{!! csrf_field() !!}

  	<br>
  	{{-- @if($proyecto->hojas->isEmpty() ) --}}
  		<input class="btn btn-primary pull-right" type="submit" value="Asignar Calificación">
  	{{-- @endif	 --}}
	  	{{-- <a class="btn btn-primary pull-right" href="{{ route('CreateEvaluateProject', $proyecto->id) }}">Asignar Calificación</a> --}}
	<br><br>
	  		<table class="table">
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
		</table>

		<a href="{{ route('showprojects') }}" class="btn btn-success">Regresar</a>
	</form>
  	</div>
  	<br>
@endsection

