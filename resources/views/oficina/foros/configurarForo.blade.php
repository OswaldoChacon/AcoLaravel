@extends('oficina.oficina')

@section('content')

<script>
  function mostrar(show, hide) {
    var show = document.getElementById(show)
    var hide = document.getElementById(hide)
    //if (show.style.display == "block") {
    show.style.display = "block";
    hide.style.display = "none";
  }
</script>

<style>
  .oculto {
    display: none;
  }
</style>
<div class="card">
  <div class="card-header">
    <h5 class="card-title">Configuracion del Foro: {{$foro->noforo}}º</h5>
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link" onclick="mostrar('contenido1','addHour')" id="agregarProfesor" href="#">Agregar profesor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" onclick="mostrar('addHour','contenido1')" id="agregarHora" href="#">Agregar horario</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    @if(session('mensaje'))
    <div class="alert alert-success" id="alert-fade">
      <p>{{session('mensaje')}}</p>
    </div>
    @endif
    @if(session('mensaje1'))
    <div class="alert alert-success" id="alert-fade">
      <p>{{session('mensaje1')}}</p>
    </div>
    @endif

    @if($errors->any())
    <div class="container">
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif

    @if ($foro->acceso==1)
    <!-- Formullario para agregar un docente como maestro de taller de investigación -->
    <form class="oculto" id="contenido1" method="post" action="/agregarProfeAforo/{{Crypt::encrypt($foro->id)}}" class="form-center">
      {{csrf_field()}}
      <br>
      <!-- <div class="container"> -->
      <div class="form-group col-12">
        <select name="maestro" class="form-control">
          <option disabled selected class="dropdown-toggle">Profesores</option>
          @foreach($docente as $docs)

          <option value="{{$docs->id}}">{{$docs->prefijo}} {{$docs->nombre}} {{$docs->paterno}} {{$docs->materno}}</option>

          @endforeach
        </select>
      </div>
      <div class="form-group col-12">
        <button type="submit" class="btn btn-primary" value="Registrar">Registrar</button>
        <!-- <a href="#" class="btn btn-danger" onclick="mostrar('contenido1','addHour')">Cancelar</a> -->
      </div>
      <!-- </div> -->
    </form>



    <form method="post" action="/addHourForo/{{Crypt::encrypt($foro->id)}}" class="form-center">
      {{csrf_field()}}
      <div id="addHour" class="oculto">
        <div class="row">
          <div class="form-group col-md-6">
            <input class="form-control" type="number" name="cantidadDias" id="cantidadDias" placeholder="Días para desarrollar el foro">
          </div>
          <div class="form-group col-md-6">
            <div class="btn-group btn-group-sm" role="group">
              <button type="button" class="btn btn-primary btn-sm" value="Registrar" onclick="capturar()">Generar</button>
              <button type="button" class="btn btn-warning btn-sm" onclick="limpiar()">Cancelar</button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div id="main">
          </div>
          <div id="guardar" style="display:none">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
    </form>
  </div>

  @endif

  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <th colspan="1">
          <h6> <strong>{{$foro->noforo}}º {{$foro->titulo}}</strong></h6>
          <h6><strong>{{$foro->periodo}} {{$foro->anoo}}</strong></h6>
        </th>
        <div class="btn-group btn-group-sm" role="group">
          <th colspan="2" <ul class="list-inline">
            <a method="POTS" href="/activar/{{Crypt::encrypt($foro->id)}} ">
              <button class="btn btn-success btn-sm bnt-block">Activar</button>
            </a>
            <a method="POTS" href="/desactivar/{{Crypt::encrypt($foro->id)}}">
              <!-- {{Crypt::encrypt($foro->id)}} -->
              <button class="btn btn-danger btn-sm bnt-block">Desactivar</button>
            </a>
            <a method="POTS" href="/cerrar/{{$foro->id}}">
              <button class="btn btn-danger btn-sm bnt-block">Cerrar Registro</button>
            </a>
            </ul>
          </th>
        </div>
      </thead>
      <tbody style="table-layout:fixed">
        <tr>
          <td colspan="1"> Jefe de Oficina: </td>
          <td colspan="2"> {{$name_jefe}}</td>
        </tr>
        @foreach ($doc as $p)
        <tr>
          <td colspan="1">Profesor de Taller: </td>
          <td colspan="2">{{$p->prefijo}} {{$p->nombre}} {{$p->paterno}} {{$p->materno}}</td>
        </tr>
        @endforeach
        <tr>
          <div class="row">
            <form class="form-inline" method="post" action="/actulizar/{{Crypt::encrypt($foro->id)}}">
              {{csrf_field()}}
              <td>Limite de alumnos por proyecto: <strong>{{$foro->lim_alumnos}}</strong> </td>
              <td><input class="form-inline" type="number" name="no_alumnos" inputmode="Numero de  foro" style='width:70px; height:25px' required /></td>
              <td><button type="submit" class="btn btn-primary btn-sm" class="form-inline" value="Registrar" name="lim">Guardar</button>
                {!! $errors->first('no_alumnos','<span class="help-block alert alert-danger">:message</span>')!!}
              </td>
            </form>
          </div>
          <!-- <p id="agregarHora">&nbsp;</p> -->
        </tr>
        <tr>
          <div class="row">
            <form class="form-inline" method="post" action="/actualizarDuracion/{{Crypt::encrypt($foro->id)}} ">
              {{csrf_field()}}
              <td>Duración de exposición por evento: <strong> {{$foro->duracion}} min </strong></td>
              <td><input class="form-inline" type="number" name="duracion" class="form-control" min="10" pattern="[0-9]" style='width:70px; height:25px' required /></td>
              <td> <button class="btn btn-primary form-inline btn-sm" value="Registrar" name="btnGuardar">Guardar</button></td>
              {!! $errors->first('duracion','<span class="help-block alert alert-danger">:message</span>')!!}
              </td>
            </form>
          </div>
        </tr>
        <tr>
          <div class="row">
            <form class="form-inline" method="post" action="/numAulas/{{Crypt::encrypt($foro->id)}} ">
              {{csrf_field()}}
              <td>Número de aulas a utilizar en el evento: <strong> {{$foro->num_aulas}} </strong></td>
              <td><input class="form-inline" type="number" name="numAulas" class="form-control" min="1" max="5" pattern="[0-9]" style='width:70px; height:25px' required /></td>
              <td> <button class="btn btn-primary form-inline btn-sm" value="Registrar" name="numeroAulas">Guardar</button></td>
              {!! $errors->first('num_aulas','<span class="help-block alert alert-danger">:message</span>')!!}
              </td>
            </form>
          </div>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <h6> <strong> Fecha y horario programado</strong></h6>
      </thead>
      <tbody>
        <tr>
          <th>Fecha</th>
          <th>Horario</th>
          <th colspan="2" align="center">Horio Break</th>
          <th>Acciones</th>
        </tr>
        @php
        $cont = 0;
        @endphp

        @foreach ($horariosForos as $key => $object)

        @php
        $posicion = 0;

        @endphp
        <tr>
          <td>{{$object->fecha}} </td>
          <td>{{$object->horario_inicio}} - {{$object->horario_termino}}</td>
          @foreach($horariobreak as $hb)
          <td>{{$hb->horario_break}}</td>
          @endforeach
          <td>
            <button class="btn btn-warning">Editar horario</button>

            <ul class="list-unstyled components">
              <li class="">
                <a href="#horas-{{$cont + 1}}" data-toggle="collapse" aria-expanded="false" class="btn btn-primary btn-sm">Agregar horario break de fecha {{$object->fecha}}</a>
                <ul class="collapse list-unstyled" id="horas-{{$cont + 1}}">

                  @php
                  for($i = 0; $i < count($intervalosContainer); $i++){ if($key==$i){ for($j=0; $j < count($intervalosContainer[$i]) ; $j++ ){ $horaExistente=false; @endphp @foreach($horariobreak as $itemC) @php if($itemC->horario_break == $intervalosContainer[$i][$j] && $object->id == $itemC->id_horarioforo){
                    $horaExistente = true;
                    }
                    @endphp
                    @endforeach
                    <li>
                      <div class="inputContainer">
                        <input {{$horaExistente == false ? '' : 'checked'}} posicion="{{$posicion}}" class="checkHorarioBreak" id-horario-foros="{{$object->id}}" style="width: 25px; height: 25px" type="checkbox" name="status" value="participa">
                        <small>{{$intervalosContainer[$i][$j]}}</small>
                      </div>
                    </li>
                    @php
                    $posicion++;
                    }
                    }
                    }
                    @endphp

                </ul>
              </li>
            </ul>
            @php
            $cont++;
            @endphp

          </td>
          <!-- <td><a href="/horarioBreak/horarioBreak"class="btn btn-primary btn-sm btnbreak">Agregar horario del break</a></td> -->
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <br>
  <!-- </div> -->
</div>
</div>

<script type="text/javascript">
  function capturar() {
    limpiar();
    var cantidad = document.getElementById("cantidadDias").value;
    var botonGuardar = document.getElementById("guardar");
    var div = document.getElementById("main");
    if (cantidad > 0) {
      botonGuardar.style.display = "block";
    }
    for (var i = 1; i <= cantidad; i++) {
      // var contenedor = document.createElement("div");
      // contenedor.setAttribute("class", "form-group");
      div.innerHTML =
        '<div class="form-group row">' +
        '<div class="form-group col-xl-3"><label>Fecha</label><input type="date" name="fecha[]" class="form-control" min="<?php $hoy = date('Y-m-d');
                                                                                                                          echo $hoy; ?>"/></div>' +
        '<div class="form-group col-xl-3"><label>Hora de inicio</label><input type="time" name="h_inicio[]" class="form-control" min="07:00" max="18:00" /></div>' +
        '<div class="form-group col-xl-3"><label>Hora de finalización</label><input type="time" name="h_end[]" class="form-control"  min="07:00" max="18:00" /></div>' +
        '</div>';
      div.appendChild(contenedor);
    }
  }

  function limpiar() {
    var div = document.getElementById("main");
    var botonGuardar = document.getElementById("guardar");
    botonGuardar.style.display = "none";
    // var cantidad = document.getElementById("cantidadToken").value = "";
    if (div !== null) {
      cantidad = "";
      while (div.hasChildNodes()) {
        div.removeChild(div.lastChild);
      }
    }
  }
  $(document).ready(function() {
    var duration = 4000; // 4 seconds
    setTimeout(function() {
      $('#alert-fade').hide("fade");
    }, duration);
  });
</script>
<!-- <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script> -->
@endsection
@push('asignarHorarioBreak')
<script src="{{asset('js/horabreak.js')}}"></script>
@endpush