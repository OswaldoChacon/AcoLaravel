@extends('oficina.oficina')

@section('content')
<div class="card">
  <h5 class="card-header">Token de Alumnos </h5>
  <div class="card-body">
    <form method="post" action="{{ route('dartokenAlumno') }}" class="form-center">
      {{ csrf_field() }}
      @if (Session::has('message'))
      <div class="alert alert alert-danger">No.Control existentes: ({{ Session::get('message') }})</div>
      @endif
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
      @foreach (range(1,$tokenN) as $token)
      <div class="form-group">
        <label for="nocontrol-{{$token}}">numero de control #{{$token}}</label>
        <input class="form-control" type="text" name="nocontrol[]" id="nocontrol-{{$token}}" class="form-control" placeholder='numero de control'>

      </div>
      @endforeach
      <button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>
    </form>
  </div>
</div>

@endsection