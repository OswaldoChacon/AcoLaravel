@extends('seminario.criterios.diapositivas.layout')

@section('contenido')
	<div class="container-fluid">
		<h1><b>Criterios de las Diapositivas</b></h1>
		
		<a class="btn btn-success pull-right" href="{{ route('criterios') }}">Regresar</a>
		<table class="table">
			<thead>
				<tr>
					<th>Criterios</th>
					<th>Ponderaciones</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($diapositivas as $diapositiva)
					<tr>
						<td>{{ $diapositiva->criterio }}</td>
						<td>{{ $diapositiva->ponderacion }}%</td>
						<td>
							<a class="btn btn-info btn-xs" href="{{ route('diapositivas.edit', $diapositiva->id) }}">Editar</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection