@extends('oficina.oficina')

@section('content')
<div class="card">
  <div class="card-header">
    <h5>Token a crear para Docentes</h5>
  </div>
  <div class="card-body">
    <form method="post" action="/profe" class="form-center">
      {{csrf_field()}}
      <div class="form-group ">
        <input class="form-control" type="number" name="tokenN" placeholder="Cuantos Token desea">
      </div>
      <button type="submit" class="btn btn-primary" value="Registrar" name="">Acceder</button>
      {!! $errors->first('password','<span class="help-block">:message</span>')!!}
    </form>
  </div>
</div>



<div class="card">
  <div class="card-body">
    <h5 class="panel-title">Total de docentes encontradas por seccion: <span style="font-weight: bold">{{$tokendocente->count()}}</span></h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Token</th>
          <th>Uso</th>
          <th>Correo</th>
        </thead>
        <tbody>
          @foreach ($tokendocente as $token)
          <tr>
            <td>{{$token->token}}</td>
            @if ($token->uso==0)
            <td><img src="{{asset('img/x.png')}}" style="height:20px;left:5%; top:30px;"></td>
            @else
            <td><img src="{{asset('img/palomita.png')}}" style="height:20px;left:5%; top:30px;"></td>
            @endif
            <td>{{$token->id_usuario}}</td>
          </tr>
          @endforeach
        </tbody>
    </div>
  </div>

  @endsection