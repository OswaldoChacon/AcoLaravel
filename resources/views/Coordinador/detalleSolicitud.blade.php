
@extends('coordinador.coordinador')
@section('content')

<div class="panel-heading">
<th>
    <h3 class="panel-title">
        <center><strong>Detalles De Solicitud</strong></center>
    </h3></th>
</div>

   
 <form  method="post"    class="form-center" action="/ActualizarResi/{{$datos->id}}"> 

{{csrf_field()}}

 {{-- <input type="hidden" name="_method" value="PUT"  class="form-control" > --}}

  {{-- <input type="hidden" name="solicitado" value="1"  class="form-control" > --}}
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
<center><button type="submit" class="btn btn-success btn-xs bnt-block">Aceptar para Residencia</button></center>
</form>




 {{-- <table  empty-cells:hide class="table table-light table-hover" style="empty-cells" CELLSPACING="6" style="width: 750px;height: 100px;">

    <thead class="thead-light">
		<tr>
			<th><h4 class="panel-title">Id_Proyecto</h4></th>
            <th><h4 class="panel-title">Lugar</h4></th>
            <th><h4 class="panel-title">Periodo</h4></th>
            <th><h4 class="panel-title">Alumno</h4></th>
           
        </tr>
       
</thead>
 </table>

 <table empty-cells:hide class="table table-bordered" style="empty-cells" id="table0" >
            <thead class="thead-light">
 <tr> 
			  <tr>        
               
            <td>

             {{$datos->id_proyectos}} 
                  
            </td> 
               <td>

             {{$datos->lugar}} 
                  
            </td> 

             <td>

             {{$datos->periodo_residencia}} 
                  
            </td> 

            <td>

             {{$datos->id_alumno}} 
                  
            </td> 
      
                     
         </tr>
           
                    
</tr>
</thead>
 </table> --}}

            @endsection