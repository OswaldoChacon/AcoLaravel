@extends('oficina.oficina')

@section('content')
@if (Session::has('message'))
<div class="alert alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card">
  <h5 class="card-header">Foros</h5>
  <div class="card-body">

    @foreach ($foro as $for)
    @if ($for->acceso==1)
    <div class="alert alert alert-warning">
      <tr>
        <td> Foro activado:
          {{$for->noforo}}
        </td>
      </tr>
    </div>
    @endif
    @endforeach

    <h5 class="panel-title">Foros: <span style="font-weight: bold">{{$foro->count()}}</span></h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Numero </th>
          <th>Titulo</th>
        </thead>
        <tbody>
          @foreach ($foro as $for)
          <tr style="background-color: {{$for->acceso == 1 ? '#00b963' : '#e8e8e8'}}">
            <td>{{$for->noforo}}</td>
            <td>{{$for->titulo}}</td>
            <td>
              <button class="btn btn-success btn-xs bnt-block" onclick="location.href='configurarForo/{{Crypt::encrypt($for->id)}}'">Configuración</button>
              <button class="btn btn-info btn-xs bnt-block" onclick="location.href='proyecto/{{Crypt::encrypt($for->id)}}'">Proyectos</button>
              <a href="/eliminarForo/{{$for->id}}"class="btn btn-danger btn-sm btnbreak">Borrar</a>
            </td>
          </tr>
          @endforeach
        </tbody>
    </div>
  </div>
</div>
@endsection
