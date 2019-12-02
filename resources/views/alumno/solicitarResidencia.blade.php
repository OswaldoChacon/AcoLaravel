
@extends('alumno.alumno')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Solicitar Residencia</strong></center>
    </h3>
</div>
<form  method="post" class="form-center">
<br>
<label for="titulo" >Id-Proyecto: </label>
{{-- <label for="idpro" >{{$proyectoForo->id}}</label> --}}
{{$control->id_proyecto}}
<br><br>
<label for="titulo" >Alumno: </label>
 {{$control->nombre}} {{$control->paterno}} {{$control->materno}}

 <br><br>
NoControl: {{Auth::guard('alumnos')->user()->nocontro}}

<br><br>
<label for="titulo" >Asesor:</label>

{{$asesorP->prefijo}}. {{$asesorP->nombre}} {{$asesorP->paterno}} {{$asesorP->materno}}
{{-- @foreach($docente as $doc)
                    @if ($proyectoForo->assesor==$doc->id)
                    {{$doc->prefijo}}. {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}
                    @endif
                    @endforeach --}}

<br><br>
<label for="titulo" >Lugar</label>
<textarea class="form-control" 
					type="text" 
					name="lugar" 
					placeholder=" Lugar "></textarea>
<br><br>
<label for="titulo" >Empresa</label>
<textarea class="form-control" 
					type="text" 
					name="Empresa" 
					placeholder=" Empresa "></textarea>
<br><br>
<label for="titulo" >Periodo</label>
<textarea class="form-control" 
					type="text" 
					name="Periodo" 
					placeholder=" Periodo "></textarea>
<br><br>

</form>


 <button class="btn btn-success btn-xs bnt-block">Solicitar</button>

                   {{-- <a href="/cancelar/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}"> --}}
                    <button class="btn btn-success btn-xs bnt-block">Cancelar</button>
                    </a>


            @endsection