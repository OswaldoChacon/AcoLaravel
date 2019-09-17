<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="panel-heading">
		<h3><center><strong>HOJA DE EVALUACIÓN</strong></center></h3>
	</div>

	<div class="container-fluid">
		<br>
		<table class="table table-bordered">
			<thead>
				@foreach($proyectos as $proyecto)
					@if ($proyecto->alumno_id == Auth::guard('alumnos')->user()->id)
						<tr>
							<th>CLAVE:</th>
							<td>{{ $proyecto->id }}</td>
						</tr>
						<tr>
							<th>TÍTULO:</th>
							<td>{{ $proyecto->titulo }}</td>
						</tr>
						<tr>
							<th>LÍNEA DE INVESTIGACIÓN:</th>
							<td>{{ $proyecto->linea }}</td>
						</tr>
						{{-- <tr>
							<th colspan="2">
								<center><a class="btn btn-info btn-lg" href="{{ route('showResults', $proyecto->id) }}">RESULTADOS</a></center>
							</th>
						</tr> --}}
					@endif
				@endforeach
			</thead>
		</table>

		<center><h4><b>Resultados</b></h4></center>
		<table class="table table-bordered">
			<thead>
				@foreach($proyectos as $proyecto)
					@if ($proyecto->alumno_id == Auth::guard('alumnos')->user()->id)
						@foreach($proyecto->hojas as $hoja)
							<tr>
								<th>{{ $hoja->docentes->pluck('id')->implode('') }}</th>
								<th>Calificación del Jurado (Escala 100)</th>
								<td>{{ $hoja->calificacion }}</td>
							</tr>
						@endforeach	
							<tr>
								<td colspan="2" align=right><b>PROMEDIO:</b></td>
								<td><b>{{ $proyecto->hojas->avg('calificacion') }}</td>
							</tr>	
					@endif
				@endforeach		
			</thead>
		</table>

		<center><h4><b>Miembros del JURADO</b></h4></center>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th></th>
						<th>DOCENTES</th>
						<th>FIRMA</th>
					</tr>
				</thead>
				<tbody>
					@foreach($proyectos as $proyecto)
						@if ($proyecto->alumno_id == Auth::guard('alumnos')->user()->id)
							@foreach($proyecto->docentes as $docente)
								<tr>
									<td><b>{{ $docente->id }}</b></td>
									<td><b>{{ $docente->nombre}} {{ $docente->paterno }} {{ $docente->materno }}</b></td>
									<td></td>
								</tr>
							@endforeach
						@endif	
					@endforeach
				</tbody>
			</table>
	</div>
</body>
</html>