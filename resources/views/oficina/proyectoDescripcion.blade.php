@extends('oficina.oficina')

@section('content')


<div class="panel-heading "style="text-align: center; "> <String>{{$foro->noforo}}º  {{$foro->titulo}}</String> 
              <br>
              <String>{{$foro->periodo}}  {{$foro->anoo}}  </String>
        </div>
    <div class="col-md-6"><br>
        <table class="table table-bordered" style="width: 750px;height: 100px;">
        <thead>
            <tr>
                <th>Título del Proyecto</th>
                <th>{{$proyectoForo->titulo}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Objetivo general</td>
                <td>{{$proyectoForo->objetivo}}</td>
            </tr>
            <tr>
                <td>Línea de Investigación</td>
                <td>{{$proyectoForo->linea}}</td>
            </tr>
             <tr>
                <td>Tipo de Titulación</td>
                <td>{{$proyectoForo->area}}</td>
            </tr>
            <tr>
                <td>Nombre de la empresa o Institución</td>
                <td>{{$proyectoForo->nombre_de_empresa}}</td>
            </tr>
        </tbody>
    </div>

  <div class="col-md-6" >
        <table class="table table-bordered" style="width: 750px;height: 50px;">
          <p>Asesor</p>
        <thead>
            <tr>
                <th>Nombre </th>
            </tr>
        </thead>
         <tbody>
            <tr>
                 @foreach($docente as $doc)
                 @if ($proyectoForo->assesor==$doc->id)
                <td >{{$doc->prefijo}} {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}</td>
                 @endif
                @endforeach
            </tr>
        </tbody>
    </div>

<div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 50px;">
          <p>Alumnos</p>
     @foreach($alumnoenproyecto as $fd)
        @foreach($alumno as $alm)
          @if ($fd->titulo==$proyectoForo->titulo)
           @if ($fd->id_alumno==$alm->id)

        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td>{{$alm->nombre}} {{$alm->paterno}} {{$alm->materno}}</td>
            </tr>
        </tbody>
         @endif
         @endif
         @endforeach
    @endforeach
    </div>



  <div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 50px;">
          <p>Maestro de Taller</p>
           @foreach($Forodoncente as $fd)
           @if ($foro->noforo==$fd->id_foro)
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td>{{$fd->n_profe}}</td>
            </tr>
        </tbody>
         @endif
       @endforeach
      
    </div>

    <div class="col-md-6">
        <table class="table table-bordered"style="width: 750px;height: 50px;">
          <p>Oficina</p>
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td>{{$foro->oficina}}</td>
            </tr>
        </tbody>
    </div>  
@endsection