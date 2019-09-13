@extends('seminario.layout')

@section('content')
	<div class="panel-heading">
	<form method="POST" action="{{ route('evaluaciones.store') }}">
	{!! csrf_field() !!}

	<input class="btn btn-primary" type="submit" value="Crear Hoja de Evaluación">
	</form>
	</div>
@endsection

