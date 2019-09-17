@extends('seminario.criterios.diapositivas.layout')

@section('contenido')
<div class="card-header">
	<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('diapositivas.create') }}" role="tab" aria-controls="description" aria-selected="true">Crear criterios</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('diapositivas.index') }}" role="tab" aria-controls="description" aria-selected="true">Criterios de diapositivas</a>
		</li>

	</ul>
</div>
<div class="card-body">
	<h5 class="card-title">Criterios de las Diapositivas</h5>
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
</div>
@endsection