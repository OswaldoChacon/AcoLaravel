
@extends('coordinador.coordinador')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Solicitudes a Residencia</strong></center>
    </h3>
</div>
  {{csrf_field()}}
    <table  empty-cells:hide class="table table-light table-hover"   style="empty-cells" >

    <thead class="thead-light">
		<tr>
			<th><h4 class="panel-title">Id_Proyecto</h4></th>
            <th><h4 class="panel-title">Periodo</h4></th>
            <th><h4 class="panel-title">Accion</h4></th>
           
        </tr>
       
</thead>
 </table>

 <table empty-cells:hide class="table table-bordered" style="empty-cells" id="table0" >
            <thead class="thead-light">
 <tr> 
 @foreach($control as $obtener)
			  <tr>        
               
            <td>

             {{$obtener->id_proyectos}} 
                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 

             <td>

             {{$obtener->periodo_residencia}} 
                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 
             <td> 
                    <a class="btn btn-info btn-xs" href="/detalleSolicitud/{{$obtener->id}}/{{$obtener->id_proyectos}} ">ver detalles</a>
                    </td>
                     
         </tr>

         
            @endforeach 
</tr></tr>

<table empty-cells:hide  >
            <thead class="thead-light">
             <td>
@foreach($control as $obtener)
 <?php
                 if (empty($obtener->id_proyectos)) {
               echo "No hay Solicitudes";
           } else {
                
                     }
                          ?>

 @endforeach 
            
       </td>      </table>
          
</tr>
</thead>
 </table>


            @endsection

