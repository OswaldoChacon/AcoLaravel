@extends('seminario.seminarios.layout')

@section('contenido')
<div class="container-fluid">
	{{-- <form method="POST" action="{{ route('evaluaciones.store') }}"> --}}
	{{-- {!! csrf_field() !!} --}}

		<table class="table">
			<thead>
				<tr>
					<th>Foro</th>
					<th>Clave</th>
					<th>Título</th>
					<th>Objetivo</th>
					<th>Calificación</th>
					{{-- <th>Acciones</th> --}}
				</tr>
			</thead>
			<tbody>
				@foreach ($proyectos as $proyecto)
				<tr>
					<td>{{ $proyecto->id_foro }}</td>
					<td>-</td>
					<td>{{ $proyecto->titulo }}</td>
					<td>{{ $proyecto->objetivo }}</td>
					<td>{{ $proyecto->calificacion }}</td>
					{{-- <td><input class="btn btn-info" type="submit" value="Crear Hoja de Evaluación"></td> --}}
				</tr>
				@endforeach
			</tbody>
		</table>
	{{-- </form> --}}
</div>
@endsection





