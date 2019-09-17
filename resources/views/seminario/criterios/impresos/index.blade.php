@extends('seminario.criterios.impresos.layout')

@section('contenido')


<div class="card-header">
	<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('impresos.create') }}" role="tab" aria-controls="description" aria-selected="true">Crear criterios</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('impresos.index') }}" role="tab" aria-controls="history" aria-selected="false">Criterios del documento impreso</a>
		</li>
	</ul>
</div>
<div class="card-body">
	<h5 class="card-title">Criterios del Documento Impreso</h5>
	<div class="table-responsive">
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
</div>
@endsection