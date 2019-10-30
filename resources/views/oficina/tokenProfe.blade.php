@extends('oficina.oficina')

@section('content')
<div class="card">
  <h5 class="card-header">Token a crear para Docentes</h5>
  <div class="card-body">
    <div class="form-group ">
      <input class="form-control" type="number" name="tokenN" id="cantidadToken" placeholder="Cuantos Token desea">
    </div>
    <!-- <button type="submit" class="btn btn-primary" value="Registrar" name="">Acceder</button> -->
    {!! $errors->first('password','<span class="help-block">:message</span>')!!}
    <button type="submit" class="btn btn-primary" value="Registrar" onclick="capturar()">Generar</button>
    <button type="button" class="btn btn-warning" value="Registrar" onclick="limpiar()">Cancelar</button>

    <br>
    <br>
    <form method="post" action="{{ route('dartokenProfe') }}" class="form-center">
      {{csrf_field()}}
      <div id="main">
      </div>
      <div id="guardar" style="display:none">
        <button type="submit" class="btn btn-primary" value="Registrar">Guardar</button>
      </div>
    </form>
  </div>
</div>


<div class="card">
  <h5 class="card-header">Total de docentes encontradas por seccion: <span style="font-weight: bold">{{$tokendocente->count()}}</span></h5>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Token</th>
          <th>Uso</th>
          <th>Matricula</th>
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
            <td>{{$token->matricula}}</td>
          </tr>
          @endforeach
        </tbody>
    </div>
  </div>
</div>



<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
@endsection