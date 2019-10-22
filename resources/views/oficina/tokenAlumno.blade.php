@extends('oficina.oficina')

@section('content')
<div class="card">
  <div class="card-header">
    <h5>Registrar token alumno</h5>
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('alumnoT') }}" class="form-center">
      {{csrf_field()}}
      <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
      <!-- <div class="form-group "> -->
        <th> <input class="form-control" type="number" name="tokenN" placeholder="¿Cuántos Tokens desea?" style='width:250px; height:32px' required ></th>
        <th><button type="submit" class="btn btn-primary" value="Registrar" name="">Generar</button></th>
      {!! $errors->first('password','<span class="help-block">:message</span>')!!}
      <!-- </div>    -->
        </thead>
      </table>
      </div>

    </form>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">
      Tokens generados: <span style="font-weight: bold">{{$tokealumno->count()}}</span>
      <ul class="nav justify-content-end">
      <li class="nav-item">
      <a href="/tokenAlumno/clean-screen" class="btn btn-primary btn-xs bnt-block btnLimpiar">Limpiar Pantalla</a>
      </li>
    </ul>

    </h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>No.control</th>
          <th>Uso</th>
        </thead>
        <tbody>
          @foreach ($tokealumno as $token)
          @if($token->ver == 1)
          <tr>
            <td>{{$token->numerocontrol}}</td>
            @if ($token->uso==0)
            <td><img src="{{asset('img/x.png')}}" style="height:20px;left:5%; top:30px;"></td>
            @else
            <td><img src="{{asset('img/palomita.png')}}" style="height:20px;left:5%; top:30px;"></td>
            @endif
          </tr>
        @endif
          @endforeach
        </tbody>

    </div>
  </div>
</div>

@endsection
