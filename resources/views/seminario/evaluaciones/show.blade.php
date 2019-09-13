@extends('docentes.docente')

@section('content')
	
	<div class="panel-heading">
		<h3><center><strong>Instituto Tecnológico de Tuxtla Gutiérrez</strong></center></h3>
		<h4><center>HOJA DE EVALUACIÓN</center></h4>
	</div>
	<br>
	
	<div class="container-fluid">		
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>CLAVE</th>
						<th>TÍTULO DEL PROYECTO</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hoja->proyectosforos as $proyecto)
					<tr>
						<td>{{ $proyecto->id }}</td>
						<td>{{ $proyecto->titulo }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
		<br>

		<a class="btn btn-info pull-right" href="{{ route('evaluaciones.edit', $hoja->id) }}">Evaluar Criterios</a>
		
		<form method="POST" action="{{ route('evaluaciones.update', $hoja->id) }}">
			{!! method_field('PUT') !!}
			{!! csrf_field() !!}
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
								<td><strong>{{ $impreso->pivot->evaluacion }}</strong></td>
							</tr>
						@endforeach
					<tr>
						<td colspan="2" align=right><strong>TOTAL</strong></td>
						<td colspan="2"><u><b>{{ $hoja->impresos->pluck('pivot')->sum('evaluacion') }}</b></u></td>
					</tr>
				</tbody>
			</table>
		</form>

		<br>
		<a class="btn btn-info pull-right" href="{{ route('editDiapo', $hoja->id) }}">Evaluar Criterios</a>
		<form>
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
				</tbody>
			</table>
		</form>
		
		<br>
		<a class="btn btn-info pull-right" href="{{ route('editResumen', $hoja->id) }}">Evaluar Criterios</a>
		<form method="POST" action="{{ route('actualizar', $hoja->id)}} ">
			{!! method_field('PUT') !!}
			{!! csrf_field() !!}
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
						@foreach($hoja->resumes as $resume)
						<tr>
							<td>{{ $resume->criterio }}</td>
							<td>{{ $resume->ponderacion }}%</td>
							<td><b>{{ $resume->pivot->evaluacion }}</b></td>
						</tr>
						@endforeach
					<tr>
						<td colspan="2" align=right><strong>TOTAL</strong></td>
						<td width="5"><input class="form-control input-sm" type="number" value="{{ $hoja->resumes->pluck('pivot')->sum('evaluacion') }}" name="calificacion" required="required"></td>
					</tr>
				</tbody>
			</table>

			<div>
  			<label for="comment">OBSERVACIONES:</label>
  				<textarea class="form-control" rows="5" id="comment" name="observaciones" placeholder="Escriba sus observaciones en este apartado."></textarea>
			</div>
			{{-- <label for="comentario">OBSERVACIONES:</label>
			<br>
	  			<input class="form-control" type="text" value="{{ $hoja->observaciones }}" name="observaciones" placeholder="Escriba sus observaciones.">
	  		<br> --}}
	  		<br>
	  		<input class="btn btn-primary btn-lg" type="submit" value="Guardar" required="required">
		</form>
		<br>
  			
	</div>	
@endsection











