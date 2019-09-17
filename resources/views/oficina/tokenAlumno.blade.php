@extends('oficina.oficina')

@section('content')
<div class="card">
  <div class="card-header">
    <h5>Registrar token alumno</h5>
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('alumnoT') }}" class="form-center">
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
    <h5 class="card-title">
      Total de alumnos encontradas por seccion: <span style="font-weight: bold">{{$tokealumno->count()}}</span>
    </h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>No.control</th>
          <th>Uso</th>
        </thead>
        <tbody>
          @foreach ($tokealumno as $token)
          <tr>
            <td>{{$token->numerocontrol}}</td>
            @if ($token->uso==0)
            <td><img src="{{asset('img/x.png')}}" style="height:20px;left:5%; top:30px;"></td>
            @else
            <td><img src="{{asset('img/palomita.png')}}" style="height:20px;left:5%; top:30px;"></td>
            @endif
          </tr>

          @endforeach
        </tbody>

    </div>
  </div>
</div>

@endsection