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
        <!--<h5 class="card-title">Configuracion del Foro: {{$foro->noforo}}º</h5>-->
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
                        <!-- <div class="btn-group btn-group-sm" role="group"> -->
                        <!-- <div> -->
                        <button type="button" class="btn btn-primary btn-sm" value="Registrar" onclick="capturar()">Generar</button>
                        <button type="button" class="btn btn-warning btn-sm" onclick="limpiar()">Cancelar</button>
                        <!-- </div> -->
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
                <form action="/configurarForoAtributos/{{Crypt::encrypt($foro->id)}}" method="POST">
                {{csrf_field()}}
                    <tr>
                        <td colspan="1">Profesor de Taller: </td>
                        <td colspan="2">{{$p->prefijo}} {{$p->nombre}} {{$p->paterno}} {{$p->materno}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <div class="row">
                            <td>Limite de alumnos por proyecto: <strong>{{$foro->lim_alumnos}}</strong> </td>
                            <td><input class="form-inline" type="number" value="{{$foro->lim_alumnos}}" name="no_alumnos" inputmode="Numero de  foro" style='width:70px; height:25px' required /></td>
                            <!--<td><button type="submit" class="btn btn-primary btn-sm" class="form-inline" value="Registrar" name="lim">Guardar</button>-->
                            {!! $errors->first('no_alumnos','<span class="help-block alert alert-danger">:message</span>')!!}
                            </td>
                        </div>
                        <!-- <p id="agregarHora">&nbsp;</p> -->
                    </tr>
                    <tr>
                        <div class="row">
                            <td>Duración de exposición por evento: <strong> {{$foro->duracion}} min </strong></td>
                            <td><input class="form-inline" type="number" name="duracion" value="{{$foro->duracion}}" class="form-control" min="10" pattern="[0-9]" style='width:70px; height:25px' required /></td>
                            <!-- <td> <button class="btn btn-primary form-inline btn-sm" value="Registrar" name="btnGuardar">Guardar</button></td> -->
                            {!! $errors->first('duracion','<span class="help-block alert alert-danger">:message</span>')!!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <td>Número de aulas a utilizar en el evento: <strong> {{$foro->num_aulas}} </strong></td>
                            <td><input class="form-inline" type="number" name="numAulas" value="{{$foro->num_aulas}}" class="form-control" min="1" max="5" pattern="[0-9]" style='width:70px; height:25px' required /></td>
                            <!-- <td> <button class="btn btn-primary form-inline btn-sm" value="Registrar" name="numeroAulas">Guardar</button></td> -->
                            {!! $errors->first('num_aulas','<span class="help-block alert alert-danger">:message</span>')!!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <td>Número de maestros a considerar como jueces para cada proyecto: <strong> {{$foro->num_maestros}} </strong></td>
                            <td><input class="form-inline" type="number" name="numMaestros" class="form-control" min="1" value="{{$foro->num_maestros}}" pattern="[0-9]" style='width:70px; height:25px' /></td>
                            <!-- <td> <button class="btn btn-primary form-inline btn-sm" value="Registrar" name="numeroMaestros">Guardar</button></td> -->
                            {!! $errors->first('num_maestros','<span class="help-block alert alert-danger">:message</span>')!!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <td>Asignar prefijo del proyecto: <strong> {{$foro->prefijo_proyecto}} </strong></td>
                            <td><input class="form-inline" value="-" name="prefijoProyecto" class="form-control" style='width:70px; height:25px' required /></td>
                            <!-- <td> <button title="¡NO OLVIDE EL GUIÓN!" class="btn btn-primary form-inline btn-sm" value="Registrar">Guardar</button></td> -->
                            {!! $errors->first('prefijo_proyecto','<span class="help-block alert alert-danger">:message</span>')!!}
                            </td>
                        </div>
                    </tr>
                    <button type="submit" class="btn-sm btn-primary">Guardar</button>
                </form>
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
                    <th colspan="3" align="center">Acciones</th>
                </tr>
                @php
                $cont = 0;
                $posicion = 0;
                @endphp

                @foreach ($horariosForos as $key => $object)
                <tr>
                    <td>{{$object->fecha}} </td>
                    <td>{{$object->horario_inicio}} - {{$object->horario_termino}}</td>
                    @foreach ($horariobreak as $key2 => $hb)
                    @php
                    if($object->id == $hb->id_horarioforo)
                    {
                    @endphp
                    <td> {{$hb->horario_break}}</td>
                    @php
                    }
                    @endphp
                    @endforeach
                    @foreach ($horariobreak as $key2 => $hb)
                    @php
                    if($object->id != $hb->id_horarioforo)
                    {
                    @endphp
                    <td> </td>
                    @php
                    }
                    @endphp
                    @endforeach
                    <td>
                        <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">Editar horario</button> -->
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal_{{$object->id}}">Editar horario</button>

                        <div class="modal fade" id="exampleModal_{{$object->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar horario </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-center">
                                            {{csrf_field()}}
                                            <input type="hidden" name="idHorario" value="{{$object->id}}" />

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Fecha </label>
                                                <input type="date" name="fecha" value="{{$object->fecha}}" class="form-control" min="<?php $hoy = date('Y-m-d');
                                                                                                                                        echo $hoy; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Hora de Inicio </label>
                                                <input type="time" name="h_inicio" value="{{$object->horario_inicio}}" class="form-control" min="07:00" max="18:00" />
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Hora de Termino </label>
                                                <input type="time" name="h_termino" value="{{$object->horario_termino}}" class="form-control" min="07:00" max="18:00" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary cambiar" data-dismiss="modal">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#borrarModal_{{$object->id}}">Borrar</button>

                        <div class="modal fade" id="borrarModal_{{$object->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> ¿Desea borrar este horario? </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-center">
                                            {{csrf_field()}}
                                            <input type="hidden" name="idHorario1" value="{{$object->id}}" />

                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label"> ¡ ADVERTENCIA ! </label>
                                                <label for="message-text" class="col-form-label">Se borraran los horarios break de este horario foro y
                                                    se borraran los registros de horarios disponibles de cada maestro en esa fecha y horario del foro eliminado.
                                                </label>
                                                <label for="message-text" class="col-form-label"> Fecha: {{$object->fecha}} Horario: {{$object->horario_inicio}} - {{$object->horario_termino}}
                                                </label>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                                        <button type="button" class="btn btn-primary borrar" data-dismiss="modal">Borrar</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <ul class="list-unstyled components">
                            <li class="">
                                <a href="#horas-{{$cont + 1}}" data-toggle="collapse" aria-expanded="false" class="btn btn-primary btn-sm">Agregar horario break</a>
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
    <form action="/guardarHorarioPDF" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" class="fomr-control" name="file">
        <!-- F-8" enctype="multipart/form-data" -->
        <button type="submit" class="btn btn-primary btn-sm">Subir horario</button>
    </form>
    <br>
    <!-- </div> -->
</div>
<!-- </div> -->


@endsection
@push('asignarHorarioBreak')
<script src="{{asset('js/horabreak.js')}}"></script>
<script src="{{asset('js/editarHorario.js')}}"></script>
<script src="{{asset('js/borrarHorario.js')}}"></script>

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
            var contenedor = document.createElement("div");
            contenedor.setAttribute("class", "form-group");
            contenedor.innerHTML =
                "<label for='matricula'> Día #" + i + "</label>" +
                '<div class="form-group row">' +
                // contenedor.innerHTML = "<label for='matricula'> Matricula #" + i + "</label>" +
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

@endpush