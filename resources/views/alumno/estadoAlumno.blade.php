
@extends('alumno.alumno')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Estado Del Proyecto</strong></center>
    </h3>
</div>

 <div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 100px;">
            <thead>
             {{--  @foreach ($ProyectoForoAlumno as $proyecto)
              @if ($ProyectoForoAlumno->alumno==Auth::guard('alumnos')->user()->id) --}}
              <tr>
                    <th>Título del Proyecto</th>
                   <td>{{$proyectos->titulo}}</td>
                    {{-- <th>{{$proyectoForo->titulo}}</th> --}}
                </tr>

                <tr>
                    <th>ID del Proyecto</th>
                    <td>{{$control->id_proyecto}}</td>
                    {{-- <th>{{$proyectoForo->id_foro}}</th> --}}
                    
                </tr>
               
                    <th colspan="2"> <a class="list-group-item" href="#">
                   Historial de cambio</a></th>
                
                    {{-- <th>{{$proyectoForo->id_foro}}</th> --}}
                    
               
              
            </thead>
            
    </div>

    <div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 100px;">
            <thead>
                <h3 class="panel-title">Integrante:</h3>
                
                <tr>
                    <th>No control</th>
                    <th>alumno</th>
                </tr>
                <tr>
                  <td>{{$control->nocontro}}</td>
                    <td name='alumnoid'>
                    {{-- {{$alm->id}} --}}
                    {{$control->nombre}} {{$control->paterno}} {{$control->materno}}</td>
                </tr>
               
            </thead>
          
          
         
         
    </div>


    <table class="table table-light table-hover"  border="3" style="width: 750px;height: 100px;">

    <thead class="thead-light">
		<tr>
			<th style="width: 10%"><h4 class="panel-title">Etapas:</h4></th>
      <th style="width: 20%"> <h4 class="panel-title">Estatus/Calificacion:</h4></th>
      <th style="width: 25%"> <h4 class="panel-title">Acciones:</h4>
     
      
      </th>
        </tr>
       
</thead>
 </table>

  <table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" >

    <thead class="thead-light">
  <tr>
			<th style="width: 20%">Registro</th>
            <td style="width: 40%" name='idProyecto'>
            
            
                 <?php
                 if (empty($control->id_proyecto)) {
               echo "Null";
           } else {
                echo "Registrado";
                     }
                          ?>
            </td>
         <td ><a class="list-group-item"  href="/proyectoAlumno/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                   Ver Detalles</a>
                   </td>
   </tr>
           </thead>
</table>


<table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" id="table0" >
            <thead class="thead-light">
 <tr> 

			  <tr>        
            <th style="width: 20%">Foro</th>        
            <td style="width: 40%">
          {{$calificaciones->calificacion_foro}}                        
            </td> 
          <td><a class="list-group-item" href="{{ route('dictamen') }}">
                   Ver Detalles</a>
                   </td>  </tr>
            
                    
</tr>
</thead>
 </table>

<table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" id="table1" >
            <thead class="thead-light">
 
    <tr>

            <tr> 
			<th style="width: 20%">Seminario</th>
            
             <td style="width: 40%" name='seminario'>
             {{$calificaciones->calificacion_seminario}}
               {{-- {{$Calificaciones->Calificacion_seminario}} --}}
             </td> 
            
             <td><a class="list-group-item" href="{{ route('dictamen') }}">
                   Ver Detalles</a>
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
              
               <td style="width: 40%"> 
               
               
                @if (empty($consultarResi->id_alumno))
           
                  @elseif (empty($consultarResi->solicitado))
             <?php  echo "Solicitada"; ?>
            @else 
            <?php    echo "Aceptada"; ?>
                     
                           @endif  


{{-- 
                            @if (empty($calificaciones->calificacion_seminario))
           
                  @elseif (empty($consultarResi->solicitado))
           <//php  echo "Solicitada"; ?>
            @else 
            < //php    echo "Aceptada"; ?>
                     
                           @endif
                           --}}
               </td>

               <td>

                @if (empty($calificaciones->calificacion_seminario))

                @elseif (empty($consultarResi->id_alumno))
                  <a class="list-group-item" href="/solicitarResidencia/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                    A Solicitar
                    </a>     
              
                @endif

              
           </td>  
               
                  
                             
       
        
            </td> 
         
</tr>
</thead>
 </table>

<script>
$(document).ready(function() {
    hideEmptyCols($("#table0"));
});
 
 
 function hideEmptyCols(table0) {
    var rows = $("tr", table0).length-1;
    var numCols = $("th", table0).length;
    for ( var i=1; i<=numCols; i++ ) {
        if ( $("span:empty", $("td:nth-child(" + i + ")", table0)).length == rows ) {
            $("td:nth-child(" + i + ")", table0).hide(); //hide <td>'s
            $("th:nth-child(" + i + ")", table0).hide(); //hide header <th>
        }
    }
}
  </script>





    <table class="table table-bordered">
        {{-- <thead> --}}


            <div class="col-md-6">
                <table class="table table-bordered" style="width: 750px;height: 100px;">
                   
                    {{-- <label name='idsolicitante'>{{Auth::guard('alumnos')->user()->id}}</label> --}}
                   

                   {{-- <a href="/cancelar/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                    <button class="btn btn-success btn-xs bnt-block">Salir</button>
                    </a> --}}


            </div>
 </table>
          


            @endsection



 
