@extends('oficina.oficina')

@section('content')
<div class="card">
  <h5 class="card-header">Proyectos del foro: {{$noforo}}º</h5>
  <div class="card-body">
  <h6 class="card-title">Total de de proyectos: </h6>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Titulo</th>
          <th>Empresa</th>
          <th>Assesor</th>
        </thead>
        <tbody>
    </div>
    @foreach ($proyectoForo as $proyecto)
    @foreach ($docentes as $doc)
    @if ($proyecto->id_foro==$id && $proyecto->id_asesor==$doc->id )
    <tr>
      <td>{{$proyecto->titulo}}</td>
      <td>{{$proyecto->nombre_de_empresa}}</td>
      <td>{{$doc->prefijo}} {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}</td>
      <td><button class="btn btn-info btn-sm bnt-block" onclick="location.href='/proyectoDescripcion/{{Crypt::encrypt($proyecto->id)}}'">Ver</button></td>
      <td><button class="btn btn-primary btn-sm bnt-block" onclick="location.href='/archivoForo/{{$proyecto->id}}'">Protocolo de investigacion</button></td>
      <td><button class="btn btn-primary btn-sm bnt-block" onclick="location.href='/archivoForo1/{{$proyecto->id}}'">Diapositiva</button></td>
      <td><button class="btn btn-primary btn-sm bnt-block" onclick="location.href='/archivoForo2/{{$proyecto->id}}'">Documentacion</button></td>
    </tr>
    </tr>
    @endif
    @endforeach
    @endforeach
    </tbody>
  </div>
</div>
@endsection
