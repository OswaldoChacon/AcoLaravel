@extends('alumno.alumno')

@section('content')

<div class="panel-heading "style="text-align: center; "> <String>{{$foro->noforo}}º  {{$foro->titulo}}</String> 
              <br>
              <String >{{$foro->periodo}}  {{$foro->anoo}}  </String>
        </div>
        <br>
<div class="container"style=" right:80%;top: 900px;width:65%;">

<div class="row">
  <div class="">
    <div class="panel panel-default">
      <div class="panel-heading"style="text-align: center;background-color: #227991; ">{{$proyectoForo->titulo}}</div>
        <div class="panel-body">
          <form method="POST" action='/diapositiva/{{Crypt::encrypt($proyectoForo->id)}}' enctype="multipart/form-data">
            {{csrf_field()}}
            
            <div class="form-group">
              <label class="col-md-3 control-label">Enviar Diapositiva:</label>
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
</div>
@endsection