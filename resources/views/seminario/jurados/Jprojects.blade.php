@extends('seminario.layout')

@section('content')
<div class="card">
	<div class="card-header">
		<h5>Asignar Jurado</h5>
	</div>
	<div class="card-body">
		<form class="form-inline">
			<div class="form-group">
				<h6 class="card-title"><b>Seleccione el número de foro: </b></h6>
			</div>
			<div class="form-group">
				<div class="dropdown">
					<button class="btn btn-xs btn-default dropdown-toggle" type="button" data-toggle="dropdown">
						<span>Seleccione el foro</span>
					</button>
					<ul class="dropdown-menu">
						@foreach($foros as $foro)
						<li><a href="{{ route('juradosprojects', $foro->id) }}"> {{ $foro->noforo }} </a></li>
						@endforeach
					</ul>
				</div>
			</div>
		</form><br>
		<table class="table">
			<thead>
				<tr>
					<th>Foro</th>
					<th>Título del Proyecto</th>
					<th>Jurado</th>
					<th>Acciones</th>
				</tr>
			</thead>

		</table>
	</div>
</div>

@endsection
