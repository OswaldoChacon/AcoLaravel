@extends('docentes.docente')

@section('content')
	
	<div class="panel-heading">
		<h3><center><strong>Criterios del Documento Impreso</strong></center></h3>
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
							@foreach($impresos as $key => $impreso)
							{{-- @php  dd($impreso->hojas); @endphp --}}
							<tr>
								<td>
									<input 
										type="checkbox" 
										value="{{ $impreso->id }}" 
										{{ $hoja->impresos->contains($impreso->id) ? 'checked' : '' }}
										name="datos[{{$key}}][impre]">
								</td>
								<td>{{ $impreso->criterio }}</td>
								<td>{{ $impreso->ponderacion }}%</td>
								<td>
									<div class="col-xs-7">
										<input 
											class="form-control input-sm" 
											type="number"  
											value="{{ old('evaluacion', @$impreso->hojas[0]->pivot->evaluacion) }}" 
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