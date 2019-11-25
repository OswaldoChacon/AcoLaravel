@extends('docentes.docente')

@section('content')
<div class="card">

    <h5 class="card-header">Proyectos asignados como jurado </h5>
    <h6 class="card-header">{{$name->prefijo}} {{$name->nombre}} {{$name->paterno}} {{$name->materno}}    </h6>

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
          @foreach ($horario as $h)
          <tr>
            <td>{{$h->fecha}}</td>
            <td>{{$h->hora}}</td>
            <td>{{$h->idpp}}</td>
            <td>{{$h->salon}}</td>
          </tr>
          @endforeach
        </tbody>

		</div>
	</div>
</div>
@endsection
