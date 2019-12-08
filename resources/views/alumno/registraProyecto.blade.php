@extends('alumno.alumno')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(function() {
    $("#productos").change(function() {
      if ($(this).val() === "Investigació(Tesis)" || $(this).val() === "Desarrollo Tecnológico(Residencia Profesional)" ||
        $(this).val() === "Innovacion Tecnológica)") {
        $("#id_input").prop("disabled", true);
      } else {
        $("#id_input").prop("disabled", false);
      }
    });
  });
</script>

<div class="card">
  <div class="card-body">
    <form method="post" action="/RegistarProyecto/{{$foro->id}}" class="form-center">
      {{csrf_field()}}
      <div class="row">
        <div class="col form-group">
          <label for="titulo">Titulo</label>
          <input type="text" class="form-control" type="text" name="titulo" placeholder=" Titulo" />
          {!! $errors->first('email','<span class="help-block alert alert-danger">:message</span>')!!}
        </div>
        <div class="col form-group">
          <label for="" class="control-label"> Linea de investigacion</label>
          <select name="categorias" id="categorias" class="form-control">
            <option value="">Linea de investigacion</option>
            @foreach($lineadeinvestigacion as $linea)
            <option value="{{$linea->id}}">{{$linea->linea}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Objetivo">Objetivo</label>
        <textarea class="form-control" type="text" name="objetivo" placeholder="Objetivo"></textarea>
        {!! $errors->first('objetivo','<span class="help-block alert alert-danger">:message</span>')!!}
      </div>
      <div class="row">
        <div class="col form-group">
          <label for="" class="control-label">Tipo de Titulación</label>
          <select class="form-control" name="productos" id="productos">
            <option value="">Tipo de Titulación</option>
            @foreach ($aredeconocimiento as $area)
            <option value="{{$area->id}}">{{$area-> areade}}</option>
            @endforeach
          </select>
        </div>
        <div class="col form-group">
          <label for="" class="control-label">Asesor</label>
          <select class="form-control" name="assesor" id="assesor">
            <option>Asesor</option>
            @foreach($docente as $fd)
            <option value="{{$fd->id}}">{{$fd->prefijo}} {{$fd->nombre}} {{$fd->paterno}} {{$fd->materno}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </form>    
    <h6>{{Auth::guard('alumnos')->user()->nombre}} {{Auth::guard('alumnos')->user()->paterno}} {{Auth::guard('alumnos')->user()->materno}} </h6>

    @foreach(range(1,$foro->lim_alumnos-1) as $token)    
    <div class="form-group">
      <!-- <label class="control-label">alumno #{{$token}}</label> -->
      <select class="form-control" name="alumno[]">
        <option>alumos</option>
        @foreach($alumnos as $alumno)
        @if (Auth::guard('alumnos')->user()->id!=$alumno->id && $alumno->acceso==0)
        <option value="{{$fd->id}}">{{$alumno->nombre}} {{$alumno->paterno}} {{$alumno->materno}}</option>
        @endif
        @endforeach
      </select>
    </div>    
    @endforeach
    <br>

    <label for="name">Nombre de Empresa</label>
    <input class="form-control" type="text" name="empresa" placeholder="empresa">
    {!! $errors->first('empresa','<span class="help-block">:message</span>')!!}
    <th><br><br>Oficina</th>
    <br>
    <!-- <td name='oficina'>{{$foro->oficina}}</td> -->
    <br><br>
    <button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>
    </form>
  </div>
</div>

<div name='foro' class="panel-heading">
  {{$foro->noforo}}º {{$foro->titulo}}
  <br>
  <th> {{$foro->periodo}} {{$foro->anoo}} </th>
  <br>
</div>
<div class="panel-body">

</div>
</div>

@endsection