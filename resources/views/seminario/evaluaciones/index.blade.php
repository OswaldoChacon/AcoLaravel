@extends('oficina.oficina')

@section('content')
<div class="card">
	<h5 class="card-header">Hojas de evaluación</h5>
	<div class="card-body">
		<br>
		@if (session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
		@endif

		<table class="table">
			<thead>
				<tr>
					<th>EVALUADOR</th>
					<th>PROYECTO</th>
					<th>CALIFICACIÓN</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@foreach($hojas as $hoja)
				<tr>
					<td>
						@foreach($hoja->docentes as $docente)
						{{ $docente->prefijo }} {{ $docente->nombre }} {{ $docente->paterno }} {{ $docente->materno}}
						@endforeach
					</td>
					<td>
						@foreach($hoja->proyectosforos as $proyecto)
						<a href="{{ route('sheets.show', $hoja->id) }}">{{ $proyecto->titulo }}</a>
						@endforeach
					</td>
					<td>{{ $hoja->calificacion }}</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('editSheets', $hoja->id) }}">Editar</a>
						<form style="display: inline" method="POST" action="{{ route('sheets.destroy', $hoja->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}

							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>



@endsection