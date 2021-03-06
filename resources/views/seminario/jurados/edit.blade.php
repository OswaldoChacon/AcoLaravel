@extends('seminario.layout')

@section('content')
<div class="panel-heading">
	<h1><strong>Título: <u>{{ $proyecto->titulo }}</u> </strong></h1>
</div>

<div class="container-fluid">
	<form method="POST" action="{{ route('jurados.update', $proyecto->id) }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}

		@foreach($docentes as $id => $name)
		<div class="checkbox">
			<label>
                <input type="checkbox" value="{{ $id }}" name="docentes[]">
                {{ $name }}

			</label>
		</div>
		@endforeach

		<input class="btn btn-primary" type="submit" value="Asignar">
	</form>

	<br><br>

	<table class="table">
		<thead>
			<th>Jurado</th>
		</thead>
		<tbody>
			<tr>

			</tr>
		</tbody>
	</table>

    <a class="btn btn-success" href="/jurados/projects">Regresar</a>
<br>
@endsection
