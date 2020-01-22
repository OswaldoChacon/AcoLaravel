@extends('alumno.alumno')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Solicitud de Cambio de Titulo de Proyecto</strong></center>
    </h3>
</div>
  <h4 class="panel-title">Por medio del presente solicito la modificacion del proyecto:</h4>


 <form  method="post"  action="/RegistarCambioNombre" class="form-center">

{{csrf_field()}}
<br>
<div class="form-group ">
<label for="titulo" >Titulo del proyecto: </label>
<input type="hidden" name="dato_ante" value="{{$proyectos->titulo}}" class="form-control" >
<input type="text" value="{{$proyectos->titulo}}" class="form-control" disabled>
</div>


<label for="titulo" >Id-Proyecto: </label>
<input type="hidden"name="id_proyecto" value="{{$control->id_proyecto}}" class="form-control" >
<input type="text" name="id_proyecto" value="{{$control->id_proyecto}}" class="form-control" disabled>
 

<br>

<label for="titulo"  >Alumno Solicitante: </label>
<input type="hidden" name="id_solicitante" value="{{$control->id}}" class="form-control" >
 
 <input type="text" name="id_alumno" value="{{$control->nombre}} {{$control->paterno}} {{$control->materno}}" class="form-control" disabled>
 <br>
 
 <label  >NoControl: </label>
 <input type="text" name="id_alumno" value="{{Auth::guard('alumnos')->user()->nocontro}}" class="form-control" disabled>
 

<br>

 <label for="asesorN" >Nuevo titulo del proyecto</label> 
                            <th> <textarea class="form-control" 
				                        	type="text" 
					                        name="tituloN" 
					                        placeholder="Ingresa el nuevo titulo">
                                 </textarea> 
                        
<br>
  <label for="asesorN" >Motivo de la solicitud</label> 
                            <textarea class="form-control" 
				                        	type="text" 
					                        name="motivoS" 
					                        placeholder=" Describe el motivo ">
                                 </textarea> 

<br>

<label for="asesorN" >Documento Anexar</label> 
                            <input type="file" name="evidencia" class="form-control" name="docSolicitud" >

<br>



<button type="submit" class="btn btn-success btn-xs bnt-block">Solicitar</button>
</form>

        <a href="/cancelar/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                    <button class="btn btn-success btn-xs bnt-block">Cancelar</button>
                    </a>
   
            @endsection



 
