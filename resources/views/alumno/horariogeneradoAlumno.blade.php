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
          <th>Salon</th>
        </thead>
        <tbody>

          <tr>
            <td>{{$horario->fecha}}</td>
            <td>{{$horario->hora}}</td>
            <td>{{$horario->salon}}</td>
          </tr>

        </tbody>

		</div>
	</div>
</div>
@endsection
