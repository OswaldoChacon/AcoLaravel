@extends('seminario.criterios.impresos.layout')

@section('contenido')
	<div class="container-fluid">
		<h1><b>Criterios del Documento Impreso</b></h1>
		
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
				@foreach($impresos as $impreso)
					<tr>
						<td>{{ $impreso->criterio }}</td>
						<td>{{ $impreso->ponderacion }}%</td>
						<td>
							<a class="btn btn-info btn-xs" href="{{ route('impresos.edit', $impreso->id) }}">Editar</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection