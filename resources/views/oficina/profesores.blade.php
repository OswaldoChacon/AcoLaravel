@extends('oficina.oficina')

@section('content')

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Docentes registrados</h5>
  </div>
  <div class="card-body">
    <h5>Cantidad de docentes: <span style="font-weight: bold">{{$profes->count()}}</span>
    </h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Matricula</th>
          <!-- <th>Correo</th> -->
          <th>Nombre</th>
          <th>Fecha</th>
          <th>Hora de entrada</th>
          <th>Hora de salida</th>
          <th>Acciones</th>
        </thead>
        <tbody>

          @foreach ($profes as $profe)
          <tr>
            <td>{{$profe->matricula}}</td>
            <td>{{$profe->nombre}}</td>
            <td>
              @foreach($profe->fechas as $fechasU)
              {{$fechasU}}<br>
              @endforeach
            </td>
            <td>
              @foreach($profe->hora_entrada as $entradaU)
              <input type="time" value="{{$entradaU}}" class="inputTime{{$profe->id}}" disabled><br>
              @endforeach
            </td>
            <td>
              @foreach($profe->hora_salida as $salidaU)
              <input type="time" value="{{$salidaU}}" class="inputTime{{$profe->id}}" disabled><br>
              @endforeach
            </td>
            <td><a class="btn btn-info btn-xs" href="{{ route('horariomaestro',$profe->id )}}">Asignar hora</a><br>
              <a href="#" class="btn btn-warning btn-xs" onclick="deshabilitar('inputTime{{$profe->id}}','editar{{$profe->id}}','cancelar{{$profe->id}}')" id="editar{{$profe->id}}">Editar</a>
              <a href="#" class="btn btn-warning btn-xs" onclick="deshabilitar('inputTime{{$profe->id}}','editar{{$profe->id}}','cancelar{{$profe->id}}')" id="cancelar{{$profe->id}}" style="display:none">Cancelar</a></td>
            <!-- onclick="mostrar('inputTime{{$profe->id}}')" -->
            <!-- <a class="btn btn-info btn-xs" href="{{ route('horariomaestro',$profe->id )}}">Editar hora</a> -->
            <!-- data-toggle="modal" data-target="#basicModal" -->
          </tr>
          @endforeach
        </tbody>
        <input type="time" class="inputTime" disabled><br>
      </table>
    </div>
  </div>
</div>





<script type="text/javascript">
  function deshabilitar(id, boton, boton2) {
    var objeto = document.getElementsByClassName(id)
    var buttons = document.getElementById(boton)
    var buttons2 = document.getElementById(boton2)
    if (objeto[0].disabled == true) {
      for (var i = 0; i < objeto.length; i++) {
        objeto[i].disabled = false
      }
      // alert("esta bloqueado");
      buttons.style.display = "none"
      buttons2.style.display = "block"
    } else {
      for (var i = 0; i < objeto.length; i++) {
        objeto[i].disabled = true;
      }
      buttons.style.display = "block"
      buttons2.style.display = "none"
      // alert("no esta bloqueado");      
    }
  }
</script>
@endsection