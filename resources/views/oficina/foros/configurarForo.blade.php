@extends('oficina.oficina')

@section('content')

<script>
  function mostrar(show, hide) {
    var show = document.getElementById(show)
    var hide = document.getElementById(hide)
    //if (show.style.display == "block") {
    show.style.display = "block";
    hide.style.display = "none";
    //} else {
    /*objeto.style.display = "block";
    buttondis.disabled = true;*/
    //}
  }
</script>

<style>
  .oculto {
    display: none;
  }
</style>
<div class="card">
  <div class="card-header">
    <h5 class="card-title">Registrar linea de investigación</h5>
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
    <div class="alert alert-success">
      <p>{{session('mensaje')}}</p>
    </div>
    @endif
    <div class="card-body">
    @if(session('mensaje1'))
    <div class="alert alert-success">
      <p>{{session('mensaje1')}}</p>
    </div>
    @endif

    <div class="container">
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    </div>

    @endif
    <!-- <div class="panel-body"> -->
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>
            <h6> <strong>{{$foro->noforo}}º {{$foro->titulo}}</strong></h6>
            <h6><strong>{{$foro->periodo}} {{$foro->anoo}}</strong></h6>
          </th>

          <th>
            <ul class="list-inline">
              <a method="POTS" href="/activar/{{Crypt::encrypt($foro->id)}} ">
                <button class="btn btn-success btn-xs bnt-block">Activar</button>
              </a>
              <a method="POTS" href="/desactivar/{{Crypt::encrypt($foro->id)}}">
                <!-- {{Crypt::encrypt($foro->id)}} -->
                <button class="btn btn-danger btn-xs bnt-block">Desactivar</button>
              </a>
              <a method="POTS" href="/cerrar/{{$foro->id}}">
                <button class="btn btn-danger btn-xs bnt-block">Cerrar Registro</button>
              </a>
            </ul>
          </th>
        </thead>
        <tbody style="table-layout:fixed">
          <td weight="2"> Jefe de Oficina:</td>
          <td>{{$foro->oficina}}</td>

          @foreach ($forodoncente as $profe)
          @if ($profe->id_foro==$foro->id)
          <tr>
            <td>Profesor de Taller: </td>
            <td>{{$profe->n_profe}}</td>
            @endif
          </tr>
          @endforeach
          <tr>
          <div class="row">
            <form class="form-inline" method="post" action="/actulizar/{{Crypt::encrypt($foro->id)}}" >
              {{csrf_field()}}
                <td>Limite de alumnos por proyecto: <strong>{{$foro->no_alumnos}}</strong> </td>
              <td><input class="form-inline" type="number" name="no_alumnos" inputmode="Numero de  foro" style='width:70px; height:25px'/>
              <button type="submit" class="btn btn-primary"  class="form-inline" value="Registrar" name="" >Guardar</button>
              {!! $errors->first('no_alumnos','<span class="help-block alert alert-danger">:message</span>')!!}
              </td>
            </form>
          </div>
          <!-- <p id="agregarHora">&nbsp;</p> -->
          </tr>
          <tr>
            <th>Fecha y horario programado</th>
          </tr>
          @foreach ($horarioForo as $object)
          <tr>
            <td>Fecha: {{$object->fecha_foro}}</td>
            <td>Horario: {{$object->horario_inicio}} - {{$object->horario_termino}} </td>
          </tr>
          @endforeach
          <tr>
            <th></th>
          </tr>
        </tbody>
      </table>
    </div>


    <table>

    </table>
    <br>
    @if ($foro->acceso==1 || $foro->accesosecundario==1)
    <!-- Formullario para agregar un docente como maestro de taller de investigación -->

    <form class="oculto" id="contenido1" method="post" action="/agregarProfeAforo/{{Crypt::encrypt($foro->id)}}" class="form-center">
      {{csrf_field()}}
      <br>
      <div class="container form-row">
        <div class="form-group col-12">
          <select name="maestro" class="form-control">
            <option disabled selected class="dropdown-toggle">Profesores</option>
            @foreach($docente as $doc)
            @if ($doc->acceso==0)
            <option value="{{$doc->id}}">{{$doc->prefijo}} {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}</option>
            @endif
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary" value="Registrar">Registrar</button>
          <!-- <a href="#" class="btn btn-danger" onclick="mostrar('contenido1','addHour')">Cancelar</a> -->
        </div>
      </div>
    </form>

    <!-- Formulario para agregar hora al foro -->
    <!-- <form class="oculto" id="addHour" method="post" action="/addHourForo/{{$foro->id}}" class="form-center"> -->
    <!-- {{csrf_field()}} -->
    <!-- </form> -->
    @endif
    <!-- </div> -->

    <!-- <div class="form-group row"> -->
    <form class="oculto" id="addHour" method="post" action="/addHourForo/{{$foro->id}}">
      {{csrf_field()}}
      <div class="field_wrapper">
        <div>
          <div class="form-group row">
            <div class="form-group col-xl-3">
              <label>Fecha</label>
              <input type='date' name="fecha[]" class="form-control" min="<?php $hoy = date("Y-m-d");
                                                                          echo $hoy; ?>" />
            </div>
            <div class="form-group col-xl-3">
              <label>Horario de inicio</label>
              <input type="time" name="h_inicio[]" class="form-control" min="07:00" max="18:00" />
            </div>
            <div class="form-group col-xl-3">
              <label>Horario de finalización</label>
              <input type="time" name="h_end[]" class="form-control" min="07:00" max="18:00" />
            </div>
            <div class="form-group col-xl-2">
              <br>
              <a href="javascript:void(0);" class="add_button" title="Agregar más fechas"><i class="fas fa-plus-circle" style="font-size:30px"></i></a>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn-primary">Guardar hora</button>
    </form>
    <!-- </div> -->
  </div>
</div>

<!-- <div class="panel-heading">docente que imparte materia </div> -->




<script type="text/javascript">
  $(document).ready(function() {
    var maxField = 3; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML =
      '<div class="remove">' +
      '<div class="form-group row">' +
      '<div class="form-group col-xl-3"><label>Fecha</label><input type="date" name="fecha[]" class="form-control" min="<?php $hoy = date('Y-m-d');
                                                                                                                        echo $hoy; ?>"/></div>' +
      '<div class="form-group col-xl-3"><label>Horario de inicio</label><input type="time" name="h_inicio[]" class="form-control" min="07:00" max="18:00" /></div>' +
      '<div class="form-group col-xl-3"><label>Horario de finalización</label><input type="time" name="h_inicio[]" class="form-control"  min="07:00" max="18:00" /></div>' +
      '<div class="form-group col-xl-2"><br><a href="javascript:void(0);" class="remove_button"><i class="fas fa-minus" style="font-size:30px"></i></a></div>' +
      '</div></div>';
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    // Agrega los nuevos input
    $(addButton).click(function() {
      //Check maximum number of input fields
      if (x < maxField) {
        x++; //Increment field counter
        $(wrapper).append(fieldHTML); //Add field html
      }
    });

    //Once remove button is clicked
    // Remueve los input
    $(wrapper).on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).closest('.remove').remove(); //Remove field html
      x--; //Decrement field counter
    });
  });
</script>
@endsection
