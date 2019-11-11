@extends('oficina.oficina')

@section('content')

<div class="card">
  <h5 class="card-header">Docentes registrados</h5>
  <div class="card-body">
    <h5>Cantidad de docentes: <span style="font-weight: bold">{{$profes->count()}}</span>
    </h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-docentes">
        <thead>
          <th>Matricula</th>
          <th>Nombre</th>
          <th>Correo</th>
        </thead>
        <tbody>

          @foreach ($profes as $profe)
          <tr>
            <td>{{$profe->matricula}}</td>
            <td>{{$profe->nombre}}</td>
            <td>{{$profe->email}}</td>                      
          </tr>
          @endforeach
        </tbody>
        <!-- <input type="time" class="inputTime" disabled><br> -->
      </table>
    </div>
  </div>
</div>
@endsection
@push('srcProfesores')
@endpush