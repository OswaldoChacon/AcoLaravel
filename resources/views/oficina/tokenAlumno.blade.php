@extends('oficina.oficina')

@section('content')
<div class="card">
  <h5 class="card-header">Registrar token alumno</h5>
  <div class="card-body">
    <!-- <form method="post" action="{{ route('alumnoT') }}" class="form-center"> -->
    <!-- {{csrf_field()}} -->
    <!-- <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead> -->
    <!-- <div class="form-group "> -->
    <!-- <input class="form-control" type="number" name="tokenN" placeholder="¿Cuántos Tokens desea?" style='width:250px; height:32px' required> -->
    <div class="form-group ">
      <input class="form-control" type="number" name="tokenN" id="cantidadToken" placeholder="Cuantos Token desea">
    </div>
    <button type="submit" class="btn btn-primary" value="Registrar" onclick="capturar()">Generar</button>
    <button type="button" class="btn btn-warning" value="Registrar" onclick="limpiar()">Cancelar</button>
    <!-- {!! $errors->first('password','<span class="help-block">:message</span>')!!} -->
    <!-- </div>    -->
    <!-- </thead>
      </table>
    </div> -->

    <!-- </form> -->

    <br><br>
    <form method="post" action="{{ route('dartokenAlumno') }}" class="form-center">
      {{csrf_field()}}
      @if (Session::has('message'))
      <div class="alert alert alert-danger">No.Control existentes: ({{ Session::get('message') }})</div>
      @endif
      <div id="guardar" style="display:none">
        <select name="profe">
          <option disabled selected class="dropdown-toggle">Profesor</option>
          @foreach($doc as $docente)
          @if ($docente->acceso==1)
          <option value="{{$docente->prefijo}} {{$docente->nombre}} {{$docente->paterno}} {{$docente->materno}}">{{$docente->prefijo}} {{$docente->nombre}} {{$docente->paterno}} {{$docente->materno}}</option>
          @endif
          @endforeach
        </select>

        <select name="grupo">
          <option disabled selected class="dropdown-toggle">Grupos</option>
          <option value="GR-A ">GR-A </option>
          <option value="GR-B">GR-B </option>
          <option value="GR-C ">GR-C </option>
        </select>
        <br><br>
        <div id="main">
        </div>
        <button type="submit" class="btn btn-primary" value="Registrar">Guardar</button>
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
          <button class="btn btn-primary btn-xs bnt-block btnLimpiar">Limpiar Pantalla</button>
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
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
@endsection