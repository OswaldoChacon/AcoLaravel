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
        <a class="nav-link" onclick="mostrar('addHour','contenido1')" id="agregarHora" href="#">Agregar hora</a>
      </li>
    </ul>

  </div>
  <div class="card-body">
    @if(session('mensaje'))
    <div class="alert alert-success">
      <p>{{session('mensaje')}}</p>
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
          <td><h6>{{$foro->noforo}}º {{$foro->titulo}}</h6>
        <h6 >{{$foro->periodo}} {{$foro->anoo}}</h6></td>

        <td>
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
        </td>
        </thead>


        <tbody>
        <tr>
            <td weight="5">Oficina:</td>
            <td>{{$foro->oficina}}</td>

        </tr>

        </tbody>
      </table>
    </div>



    <table>
      <tr>
        <th>Oficina : </th>
        <th>{{$foro->oficina}}</th>
      </tr>
      @foreach ($forodoncente as $profe)
      @if ($profe->id_foro==$foro->id)
      <tr>
        <th>Profe de :</th>
        <th>{{$profe->n_profe}} </th>
        @endif
      </tr>
      @endforeach
    </table>

    <table>
      <tr>
        <th>Limite de alumnos por proyecto:{{$foro->no_alumnos}} </th>
        @foreach ($horarioForo as $object)
        <th>Horario: {{$object->fecha_foro}} </th>
        @endforeach
      </tr>
    </table>
    <div class="row">
      <form method="post" action="/actulizar/{{Crypt::encrypt($foro->id)}}" class="form-center">
        {{csrf_field()}}
        <label for="name">Limite de alumnos por proyecto</label>
        <input class="form-inline" type="number" name="no_alumnos" inputmode="Numero de  foro " />
        {!! $errors->first('no_alumnos','<span class="help-block alert alert-danger">:message</span>')!!}
        <button type="submit" class="btn btn-primary" value="Registrar" name="">Acceder</button>
        <br>
      </form>
    </div>
    <br>
    @if ($foro->acceso==1 || $foro->accesosecundario==1)
    <!-- Formullario para agregar un docente como maestro de taller de investigación -->
    <form class="oculto" id="contenido1" method="post" action="/agregarProfeAforo/{{Crypt::encrypt($foro->id)}}" class="form-center">
      {{csrf_field()}}
      <br>
      <select name="maestro">
        <option disabled selected class="dropdown-toggle">Profesores</option>
        @foreach($docente as $doc)
        @if ($doc->acceso==0)
        <option value="{{$doc->id}}">{{$doc->prefijo}} {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}</option>
        @endif
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary" value="Registrar">Registarar</button>
      <a href="#" class="btn btn-danger" onclick="mostrar('contenido1','agregarHora')">Cancelar</a>
    </form>
    <!-- Formulario para agregar hora al foro -->
    <!-- <form class="oculto" id="addHour" method="post" action="/addHourForo/{{$foro->id}}" class="form-center"> -->
    <!-- {{csrf_field()}} -->
    <!-- </form> -->
    @endif
    <!-- </div> -->


    <form class="oculto" id="addHour" method="post" action="/addHourForo/{{$foro->id}}" class="form-center">
      {{csrf_field()}}
      <div class="field_wrapper">
        <div class="form-group">
          <div class='input-group date'>
            <input type='date' name="fecha[]" class="form-control" min="<?php $hoy = date("Y-m-d");
                                                                        echo $hoy; ?>" />
            <input type="time" name="h_inicio[]" min="07:00" max="18:00" />
            <input type="time" name="h_end[]" min="07:00" max="18:00" />
            <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <!-- <input type="text" name="field_name" value="" /> -->
        <!-- <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png" /></a> -->
        <!--  -->
      </div>
      <button type="submit" class="btn-primary">Guardar hora</button>
    </form>
  </div>
</div>

<!-- <div class="panel-heading">docente que imparte materia </div> -->




<script type="text/javascript">
  $(document).ready(function() {
    var maxField = 3; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML =
      // <input type="text" name="field_name" value=""/>
      '<div><input type="date" name="fecha[]" class="form-control" min="<?php $hoy = date('Y-m-d');
                                                                        echo $hoy; ?>"/>' +
      ' <input type="time" name="h_inicio[]" />' +
      '<a href="javascript:void(0);" class="remove_button"><i class="fas fa-minus"></i></a></div>' +
      ' <input type="time" name="h_end[]" />'; //New input field html
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
      $(this).parent('div').remove(); //Remove field html
      x--; //Decrement field counter
    });
  });
</script>
@endsection