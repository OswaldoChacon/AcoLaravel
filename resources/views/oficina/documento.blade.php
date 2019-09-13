@extends('oficina.oficina')

@section('content')
 <div class="panel-heading">Documento</div>
  <div class="panel-body">
    <iframe src="{{$url}}" width="800" height="780" style="border: none;"></iframe>
    <h1>$url</h1>
</div>
@endsection
