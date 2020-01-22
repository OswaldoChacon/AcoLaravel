

@extends('docentes.docente')
@section('content')

<div class="panel-heading">

    <h3>
        <center><strong>Estado Del Proyecto</strong></center>
    </h3>
</div>

 <div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 100px;">
            <thead>
                       @foreach($proyecto as $Proyectod)
              <tr>
                <th>Título del Proyecto</th>
                 <th>{{$Proyectod->titulo}}</th>
            </tr>
                
                
                <tr>
                    <th>ID del Proyecto</th>        
                    <th>{{$Proyectod->id}}</th>
                </tr>
                 <th colspan="2"> <a class="list-group-item" href="#">
                   Historial de cambio</a></th>
              
            </thead>
            
    </div>
     @endforeach 

      <div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 100px;">
            <thead>
                <h3 class="panel-title">Integrantes:</h3>
                @foreach($alumno as $alumnos)
                <tr>
                    <th>No control</th>
                    <th>alumno</th>
                </tr>
                <tr>
                <td>{{$alumnos->nocontro}}</td>
                <td>{{$alumnos->nombre}} {{$alumnos->paterno}} {{$alumnos->materno}}</td>
                     {{-- <td>{{$control->nocontro}}</td>
                    <td name='alumnoid'>
                    {{-- {{$alm->id}} --}}
                    {{-- {{$control->nombre}} {{$control->paterno}} {{$control->materno}}</td> --}} 
                </tr>   
            </thead>  
             @endforeach      
    </div>


     <table class="table table-light table-hover"  border="3" style="width: 750px;height: 100px;" >

    <thead class="thead-light">
		<tr>
			<th  style="width: 10%"><h4 class="panel-title">ETAPAS:</h4></th>
           <th style="width: 20%"> <h4 class="panel-title"> Estatus/Calificacion: </h4></th>
        </tr>
       
</thead>
 </table>

  <table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" >

    <thead class="thead-light">
  <tr>
			<th style="width: 20%">Registro</th>
        
            <td style="width: 43%" >completado</td>
          
   </tr>
           </thead>
</table>


<table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" id="table0" >
            <thead class="thead-light">
 <tr> 

			  <tr>        
            <th style="width: 20%">Foro</th>        
            <td style="width: 43%" >
                   {{$Proyectod->calificacion_foro}}       
            </td> 
         </tr>
            
                    
</tr>
</thead>
 </table>

<table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" id="table1" >
            <thead class="thead-light">
 
    <tr>

            <tr> 
			<th style="width: 20%">Seminario</th>
            
             <td style="width: 43%" >
                   {{$Proyectod->calificacion_seminario}}       
            </td> 
            
            
                      </tr>
              
  </tr>  
</thead>
</table>


<table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" id="table0" >
            <thead class="thead-light">
 <tr> 
		        <tr>

            <th style="width: 20%">Residencia</th>     
            
            <td style="width: 43%" >
            
            <?php
                 if (empty($consultarResi->solicitado)) {
               echo "Inabilitado";
           } else {
                echo "Aceptada";
                     }
                          ?>
            </td>     
           
         
</tr>
</thead>
 </table>
           
      @endsection