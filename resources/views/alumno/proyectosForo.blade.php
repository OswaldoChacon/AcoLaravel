@extends('alumno.alumno')

@section('content')
<div class="card">
  <div class="card-body">
    <h3 class="card-title">Total de Poryecto:</h3>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Foro</th>
          <th>Titulo</th>
          <th>Empresa</th>
        </thead>
        <tbody>
          @foreach ($ProyectoForoAlumno as $proyecto)
          @if ($proyecto->id_alumno==Auth::guard('alumnos')->user()->id)
          <tr>
            <td>{{$proyecto->foro}}</td>
            <td>{{$proyecto->titulo}}</td>
            <td>{{$proyecto->objetivo}}</td>
            <td><button class="btn btn-info btn-xs bnt-block" onclick="location.href='/proyectoDescripcionAlumno/{{Crypt::encrypt($proyecto->id)}}'">Ver</button></td>
            <td><button class="btn btn-success btn-xs bnt-block" onclick="location.href='/proyectosubir/{{Crypt::encrypt($proyecto->id)}}'">Subir Documentacion</button></td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection