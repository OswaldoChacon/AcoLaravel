@extends('docentes.docente')

@section('content')
 <div class="panel-heading">Documento</div>
  <div class="panel-body">
    <iframe src="{{$url}}" width="900" height="780" style="border: none;"></iframe>
</div>
@endsection
