@extends('alumno.alumno')

@section('content')
<div class="card">
<h5 class="card-header">Notificaciones:</h5>
  <div class="card-body">    
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Foro</th>
          <th>Titulo</th>
          <th>Alumno</th>
        </thead>
        <tbody>
          @foreach ($noticia as $proyecto)
          @foreach ($alumno as $alum)
          @if ($proyecto->alumno_envio==$alum->id)
          <tr>
            <td>{{$proyecto->foro}}</td>
            <td>{{$proyecto->titulo}}</td>
            <td>{{$alum->nombre}} {{$alum->paterno}} {{$alum->materno}}</td>
            <td><button class="btn btn-success btn-xs bnt-block" onclick="location.href='/confirmar/{{Crypt::encrypt($proyecto->id)}}'">Confirmar</button></td>
          </tr>
          @endif
          @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection