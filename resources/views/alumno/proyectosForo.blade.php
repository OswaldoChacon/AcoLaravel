@extends('alumno.alumno')

@section('content')
<div class="card">
  <h5 class="card-header">Total de Proyectos:</h5>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Foro</th>
          <th>Folio</th>>
          <th>Titulo</th>
          <th>Objetivo</th>
          <th>Empresa</th>
          <TH>Acciones</TH>
        </thead>
        <tbody>
    @foreach($proyecto as $pro)
          <tr>
            <td>{{$foro->noforo}}</td>
            <td>{{$pro->id_proyecto}}</td>
            <td>{{$pro->titulo}}</td>
            <td>{{$pro->objetivo}}</td>
            <td>{{$pro->nombre_de_empresa}}</td>
            <td><button class="btn btn-info btn-xs bnt-block" onclick="location.href='/proyectoDescripcionAlumno/'">Ver</button>
             <button class="btn btn-success btn-xs bnt-block" onclick="location.href='/proyectosubir/'">Subir Documentacion</button></td>
          </tr>
    @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
