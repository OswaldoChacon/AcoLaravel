@extends('alumno.alumno')

@section('content')
<div class="card">
  <div class="card-body">
    <h3 class="card-title">Notificaciones:</h3>
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