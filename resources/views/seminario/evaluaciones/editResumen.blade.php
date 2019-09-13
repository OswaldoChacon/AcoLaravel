@extends('docentes.docente')

@section('content')
	
	<div class="panel-heading">
		<h3><center><strong>RESUMEN</strong></center></h3>
	</div>

	<div class="container-fluid">
		<br>
		<a href="{{ route('evaluaciones.show', $hoja->id) }}" class="btn btn-success pull-right">Regresar</a>
		<form method="POST" action="{{ route('evaluaciones.update', $hoja->id) }}">
			{!! method_field('PUT') !!}
			{!! csrf_field() !!}			

					<table class="table">
						<thead>
							<tr>
								<th>Agregar</th>
								<th>Criterio</th>
								<th>Ponderación</th>
								<th>Calificación</th>
							</tr>
						</thead>
						<tbody>
							@foreach($resumes as $key => $resume)
							<tr>
								<td>
									<input 
										type="checkbox" 
										value="{{ $resume->id }}" 
										{{ $hoja->resumes->contains($resume->id) ? 'checked' : '' }}
										name="datos[{{$key}}][resume]">
								</td>
								<td>{{ $resume->criterio }}</td>
								<td>{{ $resume->ponderacion }}%</td>
								<td>
									<div class="col-xs-7">
										<input 
											class="form-control input-sm" 
											type="number"  
											value="{{ old('evaluacion', @$resume->hojas[0]->pivot->evaluacion) }}" 
											name="datos[{{$key}}][evalu]">
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				<input class="btn btn-primary" type="submit" value="Enviar">	
		</form>
		<br><br><br><br>
		<table class="table">
			<tr class="info">
				<th>Documento Impreso:</th>
				<td>{{ $hoja->impresos->pluck('pivot')->sum('evaluacion') }}</td>
			</tr>
			<tr class="danger">
				<th>Exposición de Diapositivas:</th>
				<td>{{ $hoja->diapositivas->pluck('pivot')->sum('evaluacion') }}</td>
			</tr>
		</table>
		<h5>Nota: Estas son las calificaciones asignadas al <b>Documento Impreso</b> y <b>Exposición de Diapositivas</b> no olvide realizar la operación para calcular el valor de la calificación de cada uno de estos, en este caso una Regla de Tres.</h5>
	</div>

@endsection