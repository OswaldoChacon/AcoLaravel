@extends('seminario.criterios.resumes.layout')

@section('contenido')
	<div class="container-fluid">
		<h1><b>Criterios de Resumen</b></h1>
		
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
				@foreach($resumes as $resume)
					<tr>
						<td>{{ $resume->criterio }}</td>
						<td>{{ $resume->ponderacion }}%</td>
						<td>
							<a class="btn btn-info btn-xs" href="{{ route('resumes.edit', $resume->id) }}">Editar</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection