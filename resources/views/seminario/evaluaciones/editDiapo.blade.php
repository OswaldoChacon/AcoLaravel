@extends('docentes.docente')

@section('content')
	
	<div class="panel-heading">
		<h3><center><strong>Criterios de Exposición Diapositivas</strong></center></h3>
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
							@foreach($diapositivas as $key => $diapositiva)
							<tr>
								<td>
									<input 
										type="checkbox" 
										value="{{ $diapositiva->id }}" 
										{{ $hoja->diapositivas->contains($diapositiva->id) ? 'checked' : '' }}
										name="datos[{{$key}}][diapo]">
								</td>
								<td>{{ $diapositiva->criterio }}</td>
								<td>{{ $diapositiva->ponderacion }}%</td>
								<td>
									<div class="col-xs-7">
										<input 
											class="form-control input-sm" 
											type="number"  
											value="{{ old('evaluacion', @$diapositiva->hojas[0]->pivot->evaluacion) }}" 
											name="datos[{{$key}}][evalu]"
											>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				<input class="btn btn-primary" type="submit" value="Enviar">	
		</form>
		<br>
	</div>

@endsection