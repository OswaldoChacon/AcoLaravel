@extends('seminario.seminarios.layout')

@section('contenido')
<div class="card-header">
	<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('seminarios.create') }}" role="tab" aria-controls="description" aria-selected="true">Crear seminario</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('seminarios.index') }}" role="tab" aria-controls="history" aria-selected="false">Ver seminarios</a>
		</li>
	</ul>
</div>
<div class="card-body">
	<h4><strong>Todos los Seminarios</strong></h4>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Número de Seminario</th>
				<th>Periodo</th>
				<th>Año</th>
				<th>Número de Foro</th>
				<th>Proyectos</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($seminarios as $seminario)
			<tr>
				<td>
					<a href="{{ route('seminarios.show', $seminario->id) }}">
						{{ $seminario->numeroSeminario }}
					</a>
				</td>
				<td>{{ $seminario->periodo }}</td>
				<td>{{ $seminario->anio }}</td>
				<!-- Aqui borré el noforo -->
                <!-- <td>Aqui borre noforo</td> -->
                {{--<td>{{$seminario->foro->pluck('noforo')->implode(',')}}</td>--}}
                <td>{{ $seminario->foro->noforo }}</td>
				{{-- <td>{{ $seminario->proyectoforo->pluck('maestro')->implode('') }}</td> --}}
				<td>
					<a class="btn btn-info btn-xs" href="{{ route('projects', $seminario->id) }}">Proyectos</a>
				</td>
				<td>
					<a class="btn btn-info btn-xs" href="{{ route('seminarios.edit', $seminario->id) }}">Editar</a>
					{{-- <form style="display: inline"
								method="POST"
								action="{{ route('seminarios.destroy', $seminario->id) }}">
					{!! csrf_field() !!}
					{!! method_field('DELETE') !!}

					<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
					</form> --}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@endsection
