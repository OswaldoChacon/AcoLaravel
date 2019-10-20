@extends('oficina.oficina')

@section('content')

<div class="card">
  <h5 class="card-header">Docentes registrados</h5>
  <div class="card-body">
    <h5>Cantidad de docentes: <span style="font-weight: bold">{{$profes->count()}}</span>
    </h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-docentes">
        <thead>
          <th>Matricula</th>
          <!-- <th>Correo</th> -->
          <th>Nombre</th>
          <th>Fecha de foro</th>
          <th>Hora de entrada</th>
          <th>Hora de salida</th>
          <th>Acciones</th>
        </thead>
        <tbody>

          @foreach ($profes as $profe)
          <tr>
            <td>{{$profe->matricula}}</td>
            <td>{{$profe->nombre}}</td>
            <td class="fechaForoContainer">
              @foreach($fechasForoActivo as $fechaForo)
              <p>{{$fechaForo->fechaForo}}</p>
              @endforeach
            </td>

            <td class="fechaInicioContainer">
              @php
              $horarioVacioInicio = true;
              @endphp
              @for($i = 0; $i < count($fechasForoActivo); $i++) @php $horarioVacioInicio=true; @endphp @foreach($horariosDocentes as $item) @if($item->idDocente == $profe->id)
                <input type="time" value="{{$item->inicio}}" name="inicio" class="inputTime" disabled><br>
                @php $i++; @endphp
                @php
                $horarioVacioInicio = false;
                @endphp
                @endif
                @endforeach
                @if($horarioVacioInicio)
                <input type="time" value="" name="termino" class="inputTime" disabled><br>
                @endif
                @endfor

            </td>


            <td class="fechaTerminoContainer">
              @php
              $horarioVacioTermino = true;
              @endphp
              @for($i = 0; $i < count($fechasForoActivo); $i++) @php $horarioVacioTermino=true; @endphp @foreach($horariosDocentes as $item) @if($item->idDocente == $profe->id)
                <input type="time" value="{{$item->termino}}" name="termino" class="inputTime" disabled><br>
                @php $i++; @endphp
                @php
                $horarioVacioTermino = false;
                @endphp
                @endif
                @endforeach
                @if($horarioVacioTermino)
                <input type="time" value="" name="termino" class="inputTime" disabled><br>
                @endif
                @endfor
            </td>
            <td>
              {{csrf_field()}}
              <a id-docente="{{$profe->id}}" disabled="true" class="btn btn-info btn-xs none btnAsignar">Asignar horas</a>
              <a id-docente="{{$profe->id}}" class="btn btn-warning btn-xs btnEditar">Editar</a>
              <a id-docente="{{$profe->id}}" disabled="true" class="btn btn-secondary btn-xs none btnCancelar">Cancelar</a>
            </td>
          </tr>
          @endforeach
        </tbody>
        <!-- <input type="time" class="inputTime" disabled><br> -->
      </table>
    </div>
  </div>
</div>

<!-- 
<script type="text/javascript">
  function deshabilitar(id, boton, boton2) {
    var objeto = document.getElementsByClassName(id)
    var buttons = document.getElementById(boton)
    var buttons2 = document.getElementById(boton2)
    if (objeto[0].disabled == true) {
      for (var i = 0; i < objeto.length; i++) {
        objeto[i].disabled = false;
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
</script> -->
@endsection
@push('srcProfesores')
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/profesores.js')}}"></script>
@endpush