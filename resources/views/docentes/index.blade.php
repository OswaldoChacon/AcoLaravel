@extends('docentes.docente')

@section('content')
<div class="card">
	<h5 class="card-header">Proyectos asignados como jurado </h5>
	<div class="card-body">
		<div class="container-fluid">
			{{-- <form method="POST" action="{{ route('evaluaciones.store') }}">
			{!! csrf_field() !!} --}}
			<br>
			@if (session()->has('info'))
			<div class="alert alert-success">{{ session('info') }}</div>
			@endif

			<h4>
				<center>Proyectos a Evaluar</center>
			</h4>
			<table class="table">
				<thead>
					<th>Foro</th>
					<th>Proyectos</th>
					{{-- <th>Objetivos</th> --}}
				</thead>
				<tbody>
					{{-- @foreach($docentes as $docente) --}}
					@foreach($docente->proyectosforos as $proyecto)
					<tr>
						@if(empty($proyecto->pivot->hoja_id))
						<td>{{ $proyecto->id_foro }}</td>
						<td>
							<a href="{{ route('showAssignedProject', $proyecto->id) }}">{{ $proyecto->titulo }}</a>
						</td>
						@endif

						{{-- <td><a class="btn btn-info btn-sm" href="{{ route('downloadEvaluation', $proyectos->id)}}">Descargar PDF</a></td> --}}
					</tr>
					@endforeach
					{{-- @foreach($docente->hojas as $hoja)
			  			<td>
			  				<a class="btn btn-info btn-sm" href="{{ route('showEvaluation', $hoja->id) }}">Ver Calificación Asignada</a>
					</td>
					@endforeach --}}
					{{-- @endforeach --}}
				</tbody>
			</table>
			<h4>
				<center>Proyectos Evaluados</center>
			</h4>
			<table class="table">
				<thead>
					<th>Foro</th>
					<th>Proyectos</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					{{-- @foreach($docentes as $docente)
		  			@if ($docente->id == Auth::guard('docentes')->user()->id) --}}
					@foreach($docente->hojas as $hoja)
					@foreach($hoja->proyectosforos as $proyecto)
					<tr>
						<td>{{ $proyecto->id_foro }}</td>
						<td>
							<a href="{{ route('showAssignedProjectEvaluation', $proyecto->id) }}">{{ $proyecto->titulo }}</a>
						</td>
						<td>
							<a class="btn btn-info btn-sm" href="{{ route('showEvaluation', $hoja->id) }}">Ver Calificación Asignada</a>
						</td>
					</tr>
					@endforeach
					@endforeach
					{{-- @endif
  				@endforeach --}}
				</tbody>
			</table>
			{{-- </form> --}}
		</div>
	</div>
</div>
@endsection