@extends('docentes.docente')

@section('content')
    <div class="panel-heading">
    <h3 class="panel-title">Notificaciones:</h3>
  </div>
  <div class="panel-body">
   <div class="table-responsive">
     <table class="table table-striped table-hover" >
  <thead>
    <th>Foro</th>
    <th>Titulo</th>
    <th>Alumno</th>
  </thead>
  <tbody>
</div>
@foreach ($noticia as $proyecto)
 @foreach ($alumno as $alum)
  @if ($proyecto->alumno_envio==$alum->id)
     <tr>
      <td>{{$proyecto->foro}}</td>
      <td>{{$proyecto->titulo}}</td>
      <td>{{$alum->nombre}} {{$alum->paterno}} {{$alum->materno}}</td>
      <td><button class="btn btn-success btn-xs bnt-block" onclick="location.href='/confirmardocentes/{{Crypt::encrypt($proyecto->id)}}'">Confirmar</button></td> 
    </tr>
    @endif
  @endforeach 
@endforeach 
      </tbody>
  </div>
</div>
@endsection
