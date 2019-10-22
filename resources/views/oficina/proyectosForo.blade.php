@extends('oficina.oficina')

@section('content')
  <div class="panel-heading">
    <h3 class="panel-title">Total de Poryecto:</h3>
  </div>
  <div class="panel-body">
   <div class="table-responsive">
     <table class="table table-striped table-hover" >
  <thead>
    <th>Titulo</th>
    <th>Empresa</th>
    <th>Assesor</th>
  </thead>
  <tbody>
</div>
 @foreach ($proyectoForo as $proyecto)
 @foreach ($docentes as $doc)
   @if ($proyecto->id_foro==$id && $proyecto->assesor==$doc->id )
     <tr>
      <td>{{$proyecto->titulo}}</td>
      <td>{{$proyecto->nombre_de_empresa}}</td>
      <td>{{$doc->prefijo}} {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}</td>
      <td><button class="btn btn-info btn-xs bnt-block" onclick="location.href='/proyectoDescripcion/{{Crypt::encrypt($proyecto->id)}}'">Ver</button></td>
          <td><button class="btn btn-primary btn-xs bnt-block" onclick="location.href='/archivoForo/{{$proyecto->id}}'">protocolo de investigacion</button></td>
        <td><button class="btn btn-primary btn-xs bnt-block" onclick="location.href='/archivoForo1/{{$proyecto->id}}'">Diapositiva</button></td>
        <td><button class="btn btn-primary btn-xs bnt-block" onclick="location.href='/archivoForo2/{{$proyecto->id}}'">Documentacion</button></td>
    </tr>
    </tr>
   @endif
   @endforeach
  @endforeach
      </tbody>
  </div>
</div>
@endsection
