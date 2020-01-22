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
  <h5 class="card-header">Registro de proyecto</h5>
  <div class="card-body">
    <div class="container">
      <h3>{{$foro->noforo}}º {{$foro->titulo}}<br>
        {{$foro->periodo}} {{$foro->anoo}}
      </h3>
    </div>
    <form method="post" action="/RegistarProyecto/{{$foro->id}}" class="form-center">
      {{csrf_field()}}
      <div class="row">
        <div class="col form-group">
          <label for="titulo">Titulo</label>
          <input type="text" class="form-control" type="text" name="titulo" placeholder=" Titulo" />
          {!! $errors->first('titulo','<span class="text-danger">:message</span>')!!}          
        </div>
        <div class="col form-group">
          <label for="" class="control-label"> Linea de investigacion</label>
          <select name="lineainv" id="categorias" class="form-control">
            <option value="">Linea de investigacion</option>
            @foreach($lineadeinvestigacion as $linea)
            <option value="{{$linea->id}}">{{$linea->linea}}</option>
            @endforeach
          </select>
          {!! $errors->first('lineainv','<span class="text-danger">:message</span>')!!}          
        </div>
      </div>
      <div class="form-group">
        <label for="Objetivo">Objetivo</label>
        <textarea class="form-control" type="text" name="objetivo" placeholder="Objetivo"></textarea>
        {!! $errors->first('objetivo','<span class="text-danger">:message</span>')!!}
      </div>
      <div class="row">
        <div class="col form-group">
          <label for="" class="control-label">Tipo de Titulación</label>
          <select class="form-control" name="area_conoc">
            <option value="">Tipo de Titulación</option>
            @foreach ($aredeconocimiento as $area)
            <option value="{{$area->id}}">{{$area->areade}}</option>
            @endforeach
          </select>
          {!! $errors->first('area_conoc','<span class="text-danger">:message</span>')!!}
        </div>
        <div class="col form-group">
          <label for="" class="control-label">Asesor</label>
          <select class="form-control" name="asesor">
            <option value="">Asesor</option>
            @foreach($docente as $fd)
            <option value="{{$fd->id}}">{{$fd->prefijo}} {{$fd->nombre}} {{$fd->paterno}} {{$fd->materno}}</option>
            @endforeach
          </select>
          {!! $errors->first('asesor','<span class="text-danger">:message</span>')!!}
        </div>
      </div>
      <div class="form-group">
        <label for="name">Nombre de Empresa</label>
        <input class="form-control" type="text" name="empresa" placeholder="empresa">
        {!! $errors->first('empresa','<span class="help-block">:message</span>')!!}
      </div>
      <h5>Integrantes</h5>
      <h6>Integrante #1: {{Auth::guard('alumnos')->user()->nombre}} {{Auth::guard('alumnos')->user()->paterno}} {{Auth::guard('alumnos')->user()->materno}} </h6>
      @foreach(range(2,$foro->lim_alumnos) as $token)
      <div class="form-group">
        <label class="control-label">Integrante #{{$token}}</label>
        <select class="form-control" name="alumno[]">
          <option>alumos</option>
          @foreach($alumnos as $alumno)
          @if (Auth::guard('alumnos')->user()->id!=$alumno->id && $alumno->id_proyecto ==null)
          <!-- && $alumno->acceso==0 -->
          <option value="{{$fd->id}}">{{$alumno->nombre}} {{$alumno->paterno}} {{$alumno->materno}}</option>
          @endif
          @endforeach
        </select>
      </div>
      @endforeach     
      <!-- <td name='oficina'>{{$foro->oficina}}</td> -->
      <button type="submit" class="btn btn-primary btn-sm" value="Registrar" name="">Guardar</button>
    </form>
  </div>  
</div>

@endsection