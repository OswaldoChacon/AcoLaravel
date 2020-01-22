@extends('coordinador.coordinador')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Detalle de Residencia Aprobada</strong></center>
    </h3>
</div>

<br>
<div class="form-group ">

{{-- <label for="titulo" >Id-Proyecto: </label>
<input type="text" name="id_proyecto" value="{{$datos->id_proyectos}} {{$datosProyecto ->titulo}}" class="form-control" disabled> --}}
<input type="hidden" name="estado" value="1" class="form-control" disabled>
 <label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Id-Proyecto: </strong> </FONT> {{$datos->id_proyectos}} </label>

</div>

<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Nombre del proyecto: </strong> </FONT> {{$datosProyecto ->titulo}} </label>

<br>

 <label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Alumno: </strong> </FONT> {{$alumno->nombre}} {{$alumno->paterno}} {{$alumno->materno}} </label>


 <br>

 <label for="titulo" class="form-control"> <FONT SIZE=4> <strong >NoControl: </strong> </FONT> {{$alumno->nocontro}} </label>


<br>

<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Asesor: </strong> </FONT> {{$datosProyecto->id_asesor}}  {{$datosAsesorG->prefijo}} {{$datosAsesorG->nombre}} {{$datosAsesorG->paterno}} {{$datosAsesorG->materno}}</label>


<br>

<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Empresa: </strong> </FONT> {{$datosProyecto->nombre_de_empresa}} </label>

<br>

		<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Periodo: </strong> </FONT> {{$datos->periodo_residencia}} </label>


<br>

<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Lugar: </strong> </FONT> {{$datos->lugar}} </label>

<br>



       @endsection
