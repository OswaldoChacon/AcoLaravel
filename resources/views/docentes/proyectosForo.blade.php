@extends('docentes.docente')

@section('content')
  <div class="panel-heading">
    <h3 class="panel-title">Total de Poryecto assesor:</h3>
  </div>
  <div class="panel-body">
   <div class="table-responsive">
     <table class="table table-striped table-hover" >
  <thead>
    <th>Titulo</th>
    <th>Empresa</th>
    <th>Maestro</th>
    <th>Empresa</th>
  </thead>
  <tbody>
</div>
    
 @foreach ($ProyectoForo as $proyecto)
    @if ($proyecto->assesor==Auth::guard('docentes')->user()->id)
     <tr>
      <td>{{$proyecto->titulo}}</td>
      <td>{{$proyecto->objetivo}}</td>
      <td>{{$proyecto->maestro}}</td>
      <td>{{$proyecto->nombre_de_empresa}}</td>
      <td><button class="btn btn-info btn-xs bnt-block" onclick="location.href='/proyectoDescripcionDocente/{{Crypt::encrypt($proyecto->id)}}'">Ver</button></td> 


        <td><button class="btn btn-primary btn-xs bnt-block" onclick="location.href='/archivo/{{$proyecto->id}}'">protocolo de investigacion</button></td> 
        <td><button class="btn btn-primary btn-xs bnt-block" onclick="location.href='/archivo1/{{$proyecto->id}}'">Diapositiva</button></td> 
        <td><button class="btn btn-primary btn-xs bnt-block" onclick="location.href='/archivo2/{{$proyecto->id}}'">Documentacion</button></td> 
    </tr>
    @endif
  @endforeach 
      </tbody>
  </div>
</div>
@endsection
