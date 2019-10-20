@extends('oficina.oficina')

@section('content')
<div class="card">  
    <h5 class="card-header">Alumnos registrados</h5>  
  <div class="card-body">
    <h5 class="card-title">
      Total de alumnos: <span style="font-weight: bold">{{$alumnos->count()}}</span>
    </h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>No. Control</th>
          <th>Correo</th>
          <th>Nombre</th>
          <th>Grupo</th>
        </thead>
        <tbody>

          @foreach ($alumnos as $alumno)
          <tr>
            <td>{{$alumno->nocontro}}</td>
            <td>{{$alumno->email}}</td>
            <td>{{$alumno->nombre}} {{$alumno->paterno}}. {{$alumno->materno}}</td>
            <td>{{$alumno->grupo}}</td>

          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>



@endsection