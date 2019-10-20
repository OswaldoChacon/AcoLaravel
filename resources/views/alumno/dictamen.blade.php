@extends('alumno.alumno')

@section('content')
<div class="card">
	<h5 class="card-header">HOJA DE EVALUACIÓN</h5>
	<div class="card-body">
		<!-- <div class="container-fluid"> -->
		<div class="table-responsive">
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

			<center>
				<h4><b>Resultados</b></h4>
			</center>
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

			{{-- <center><h4><b>Miembros del JURADO</b></h4></center>
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
			</table> --}}

			<center>
				<h4><b>Miembros del JURADO</b></h4>
			</center>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th></th>
						<th>DOCENTE</th>
						<th>FIRMA</th>
					</tr>
				</thead>
				<tbody>
					@foreach($proyectos as $proyecto)
					@if ($proyecto->alumno_id == Auth::guard('alumnos')->user()->id)
					@foreach($proyecto->hojas as $hoja)
					<tr>
						<td><b>{{ $hoja->docentes->pluck('id')->implode('') }}</b></td>
						<td><b><a href="{{ route('mostrarEvaluacion', $hoja->id) }}">
									@foreach($hoja->docentes as $docente)
									{{ $docente->nombre}} {{ $docente->paterno }} {{ $docente->materno }}
									@endforeach
								</a></b></td>
						<td></td>
					</tr>
					@endforeach
					@endif
					@endforeach
				</tbody>
			</table>
			<h6><b>Nota: Si desea ver más detallamente su evaluación de clic en el nombre del docente.</b></h6>
			<br>
			<a class="btn btn-primary pull-right" href="{{ route('download') }}">Descargar PDF</a>
			<br><br>
		</div>
	</div>
</div>
@endsection