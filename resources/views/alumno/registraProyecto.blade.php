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


<div name='foro' class="panel-heading"> {{$foro->noforo}}º {{$foro->titulo}}
  <br>
  <th> {{$foro->periodo}} {{$foro->anoo}} </th>
  <br>
</div>
<div class="panel-body">
  <form method="post" action="/RegistarProyecto/{{$foro->id}}" class="form-center">
    {{csrf_field()}}
    <label for="titulo">Titulo</label>
    <textarea class="form-control" type="text" name="titulo" placeholder=" Titulo "></textarea>
    {!! $errors->first('email','<span class="help-block alert alert-danger">:message</span>')!!}
    <br><br>

    <label for="Objetivo">Objetivo</label>
    <textarea class="form-control" type="text" name="objetivo" placeholder=" Objetivo "></textarea>
    {!! $errors->first('objetivo','<span class="help-block alert alert-danger">:message</span>')!!}
    <br><br>

    <div class="col-md-3">
      <label for="" class="control-label"> Linea de investigacion</label>
      <select name="categorias" id="categorias" class="form-control">
        <option value="">Linea de investigacion</option>
        @foreach($lineadeinvestigacion as $linea)
        <option value="{{$linea->linea}}">{{$linea->linea}}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label for="" class="control-label">Tipo de Titulación</label>
      <select class="form-control" name="productos" id="productos">
        <option value="Investigació(Tesis)">Investigació(Tesis)</option>
        <option value="Desarrollo Tecnológico(Residencia Profesional)">Desarrollo Tecnológico(Residencia Profesional)</option>
        <option value="Innovacion Tecnológica">Innovacion Tecnológica</option>
        <option value="Otros">Otros</option>
      </select> <br>
      <p>Otros</p><input name="id_input" id="id_input" type="text" disabled>
    </div>
    <div class="col-md-3">
      <label for="" class="control-label">Asesor</label>
      <select class="form-control" name="assesor">
        <option>Asesor</option>
        @foreach($docente as $fd)
        <option value="{{$fd->id}}">{{$fd->prefijo}} {{$fd->nombre}} {{$fd->paterno}} {{$fd->materno}}</option>
        @endforeach
      </select><br><br>
    </div>
    <br><br>
    <br><br> <br><br><br>
    <th>Alumno #1</th>
    <br>
    <h4>{{Auth::guard('alumnos')->user()->nombre}} {{Auth::guard('alumnos')->user()->paterno}} {{Auth::guard('alumnos')->user()->materno}} </h4>
    <br>

    @foreach (range(2,$foro->no_alumnos) as $token)
    @if ($token>=2)
    <div class="form-group">
      <label for="" class="control-label">alumno #{{$token}}</label>
      <select class="form-control" name="alumno[]">
        <option>alumos</option>
        @foreach($alumno as $fd)
        @if (Auth::guard('alumnos')->user()->id!=$fd->id && $fd->acceso==0)
        <option value="{{$fd->id}}">{{$fd->nombre}} {{$fd->paterno}} {{$fd->materno}}</option>
        @endif
        @endforeach
      </select>
    </div>
    @endif
    @endforeach
    <br>

    <label for="name">Nombre de Empresa</label>
    <input class="form-control" type="text" name="empresa" placeholder="empresa">
    {!! $errors->first('empresa','<span class="help-block">:message</span>')!!}
    <th><br><br>Oficina</th>
    <br>
    <td name='oficina'>{{$foro->oficina}}</td>
    <br><br>
    <button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>
  </form>
</div>
</div>

@endsection