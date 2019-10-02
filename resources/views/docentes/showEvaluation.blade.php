@extends('docentes.docente')

@section('content')

	<div class="panel-heading">
		<h3><center><strong>Instituto Tecnológico de Tuxtla Gutiérrez</strong></center></h3>
		<h4><center>HOJA DE EVALUACIÓN</center></h4>
	</div>

	<div class="container-fluid">
		<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>CLAVE</th>
						<th>TÍTULO DEL PROYECTO</th>
						<th>FECHA</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hoja->proyectosforos as $proyecto)
					{{-- @foreach($docente->proyectosforos as $proyecto) --}}
					<tr>
						<td>{{ $proyecto->id }}</td>
						<td>{{ $proyecto->titulo }}</td>
						<td>{{ $proyecto->created_at }}</td>
					</tr>
					{{-- @endforeach --}}
					@endforeach
				</tbody>
			</table>

			{{-- @foreach($proyecto->hojas as $hoja)
				<a class="btn btn-info pull-right" href="{{ route('evaluaciones.show', $hoja->id) }}">Editar Calificación</a>
			@endforeach --}}
			
			<table class="table table-bordered">
				<caption>DOCUMENTO IMPRESO</caption>
				<thead>
					<tr>
						<th>CONCEPTOS A EVALUAR</th>
						<th>PONDERACIÓN</th>
						<th>EVALUACIÓN</th>
					</tr>
				</thead>
				<tbody>
							@foreach($hoja->impresos as $impreso)
								<tr>
									<td>{{ $impreso->criterio }}</td>
									<td>{{ $impreso->ponderacion }}%</td>
									<td>{{ $impreso->pivot->evaluacion }}</td>
								</tr>
							@endforeach
								<tr>
									<td colspan="2" align=right><strong>TOTAL</strong></td>
									<td><u><b>{{ $hoja->impresos->pluck('pivot')->sum('evaluacion') }}</b></u></td>
								</tr>
				</tbody>
			</table>
			<table class="table table-bordered">
				<caption>EXPOSICIÓN DE DIAPOSITIVAS</caption>
				<thead>
					<tr>
						<th>CONCEPTOS A EVALUAR</th>
						<th>PONDERACIÓN</th>
						<th>EVALUACIÓN</th>
					</tr>
				</thead>
				<tbody>
					{{-- @foreach($docente->hojas as $hoja) --}}
						@foreach($hoja->diapositivas as $diapositiva)
							<tr>
								<td>{{ $diapositiva->criterio }}</td>
								<td>{{ $diapositiva->ponderacion }}%</td>
								<td><b>{{ $diapositiva->pivot->evaluacion }}</b></td>
							</tr>
						@endforeach	
							<tr>
								<td colspan="2" align=right><strong>TOTAL</strong></td>
								<td><u><b>{{ $hoja->diapositivas->pluck('pivot')->sum('evaluacion') }}</b></u></td>
							</tr>
					{{-- @endforeach --}}
				</tbody>
			</table>
			<table class="table table-bordered">
				<caption>RESUMEN</caption>
				<thead>
					<tr>
						<th>CONCEPTOS A EVALUAR</th>
						<th>PONDERACIÓN</th>
						<th>EVALUACIÓN</th>
					</tr>
				</thead>
				<tbody>
						{{-- @foreach($docente->hojas as $hoja) --}}
							@foreach($hoja->resumes as $resume)
								<tr>
									<td>{{ $resume->criterio }}</td>
									<td>{{ $resume->ponderacion }}%</td>
									<td><b>{{ $resume->pivot->evaluacion }}</b></td>
								</tr>
							@endforeach	
								<tr>
									<td colspan="2" align=right><strong>TOTAL</strong></td>
									<td><b>{{ $hoja->resumes->pluck('pivot')->sum('evaluacion') }}</b></td>
								</tr>
						{{-- @endforeach --}}
				</tbody>
			</table>
			<h3><center>OBSERVACIONES:</center></h3>
			{{-- @foreach($docente->hojas as $hoja) --}}
				<center><label>{{ $hoja->observaciones }}</label></center>
			{{-- @endforeach --}}
			<br>
			<a href="{{ route('showprojects') }}" class="btn btn-success">Regresar</a>
	</div>
<br>
@endsection