@extends('seminario.layout')

@section('content')
<div class="card">
	<div class="card-header">
		<h5><strong>Asignación de Criterios</strong></h5>
	</div>
	<div class="card-body">
		<table class="table">
			<thead>
				<th>Puntos a Asignar</th>
				<th>Acciones</th>
			</thead>
			<tbody>
				<tr>
					<td><a href="{{ route('impresos.index') }}">Criterios del Documento Impreso</a></td>
					<td><a class="btn btn-info" href="{{ route('impresos.create') }}">Asignar</a></td>
				</tr>
				<tr>
					<td><a href="{{ route('diapositivas.index') }}">Criterios de Exposición del Proyecto</a></td>
					<td><a class="btn btn-warning" href="{{ route('diapositivas.create') }}">Asignar</a></td>
				</tr>
				<tr>
					<td><a href="{{ route('resumes.index') }}">Criterios de Resumen</a></td>
					<td><a class="btn btn-danger" href="{{ route('resumes.create') }}">Asignar</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection