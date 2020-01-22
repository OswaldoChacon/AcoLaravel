@extends('seminario.layout')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Solicitudes De cambio</strong></center>
    </h3>
</div>
  {{csrf_field()}}
    <table  empty-cells:hide class="table table-light table-hover" style="empty-cells" CELLSPACING="6" style="width: 750px;height: 100px;">

    <thead class="thead-light">
		<tr>
			<th><h4 class="panel-title">Id de Proyecto</h4></th>
            <th><h4 class="panel-title">Motivo</h4></th>
            <th><h4 class="panel-title">Tipo de cambio</h4></th>
             <th><h4 class="panel-title">Acciones</h4></th>
           
        </tr>
       
</thead>
 </table>

 <table empty-cells:hide class="table table-bordered" style="empty-cells" id="table0" >
            <thead class="thead-light">
 <tr> 
 @foreach($control as $obtener)
			  <tr>        
               
            <td>

             {{$obtener->id_proyecto}} 
                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 

             <td>

             {{$obtener->motivo}} 
                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 

            <td>

             {{$obtener->id_tipocambio}} 
                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 
             <td> 
                    <a class="btn btn-info btn-xs" href="#">ver detalles</a>
                    </td>
                     
         </tr>
            @endforeach 
                    
</tr>
</thead>
 </table>


            @endsection

