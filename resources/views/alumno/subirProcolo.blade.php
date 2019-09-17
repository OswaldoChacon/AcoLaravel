@extends('alumno.alumno')

@section('content')

<style>
.button {
  display: inline-block;
  padding: 15px 25px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #00b386;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #00b386}

.button:active {
  background-color: #00b386;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
<div class="panel-heading "style="text-align: center; "> <String>{{$foro->noforo}}º  {{$foro->titulo}}</String> 
              <br>
              <String >{{$foro->periodo}}  {{$foro->anoo}}  </String>
        </div>
        <br>
<div class="container"style=" right:80%;top: 900px;width:65%;">
<div class="row">
  <div class="">
    <div class="panel panel-default">
      <div class="panel-heading"style="text-align: center;background-color:#00cc99;">{{$proyectoForo->titulo}}</div>
        <div class="panel-body">
          <form method="POST" action='/SubirProtocolo/{{Crypt::encrypt($proyectoForo->id)}}'>
            {{csrf_field()}}
            @if ($proyectoForo->calificacion <=69)
            <button class="button" style="right:80%;top: 900px;width:65%;">Subir Protocolo</button>
            <br><br><br>
            <?php //endif ?>  
          </form>

          <form method="POST" action='/SubirDiapositiva/{{Crypt::encrypt($proyectoForo->id)}}'>
            {{csrf_field()}}
            @if ($proyectoForo->calificacion <=69)
            <button class="button" style="right:80%;top: 900px;width:65%;">Subir Diapositivas</button>
            <br><br><br>
           @endif 
            </form>
            
            <form method="POST" action='/SubirSeminario/{{Crypt::encrypt($proyectoForo->id)}}'>
            {{csrf_field()}}
            @if ($proyectoForo->calificacion >=70)
            <button class="button" style="right:80%;top: 900px;width:65%;">Subir seminario</button>
            <br><br><br>
           @endif
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<div class="row">
  <div class="">
    <div class="panel panel-default">
      <div class="panel-heading"style="text-align: center;background-color: #227991; ">{{$proyectoForo->titulo}}</div>
        <div class="panel-body">
          <form method="POST" action='/create/{{Crypt::encrypt($proyectoForo->id)}}' enctype="multipart/form-data">
            {{csrf_field()}}
            
            <div class="form-group">
              <label class="col-md-3 control-label">Enviar Protocolo:</label>
              <div class="col-md-6">
                <input type="file" class="form-control" name="protocolo" >
                {!! $errors->first("'Subir documento'",'<span class="help-block">:message</span>')!!}
              </div>
            </div>
              <br><br>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>-->
@endsection