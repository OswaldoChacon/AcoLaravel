@extends('alumno.alumno')
@section('content')
<div class="card">

    <h5 class="card-header">Horario asignado para exponer </h5>
    <h6 class="card-header">{{$name->nombre}} {{$name->paterno}} {{$name->materno}}</h6>

	<div class="card-body">
		<div class="container-fluid">
        <table class="table table-striped table-hover">
        <thead>
          <th>Fecha </th>
          <th>Hora</th>
          <th>Proyecto</th>
          <th>Salon</th>

        </thead>
        <tbody>
        @if(Session::has('mensage'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('mensage') }}</p>
        @endif
        @if(Session::has('mens'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('mens') }}</p>
        @endif

        @if($clave != null || $horario != null)

          <tr>
            <td>{{$horario->fecha}}</td>
            <td>{{$horario->hora}}</td>
            <td>{{$id_prefijo}}</td>
            <td>{{$horario->salon}}</td>
          </tr>

        @endif


        </tbody>

		</div>
	</div>
</div>
@endsection
