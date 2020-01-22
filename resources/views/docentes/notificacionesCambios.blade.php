@extends('docentes.docente')

@section('content')
<div class="card">
  <h5 class="card-header">Notificaciones</h5>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
         <th><h4 class="panel-title">Id de Proyecto</h4></th>
            <th><h4 class="panel-title">Motivo</h4></th>
            <th><h4 class="panel-title">Tipo de cambio</h4></th>
             <th><h4 class="panel-title">Acciones</h4></th>
        </thead>
        <tbody>
    </div>
    @foreach($datosProyectos as $obtener)
     
			  <tr>        
               
            <td>

             

             {{$obtener->id_proyecto}} 
                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 
           <td>

               {{$obtener->motivo}} 

             
                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 
         <td>@foreach($tipocambio as $var)

               {{-- {{$obtener->id_tipocambio}}  --}}
             
               @if(($obtener->id_tipocambio)==($var->id_tipocambio))
                   {{$var->nombre_cambio}} 
               @endif
                 @endforeach 
             

                   {{-- {{$Proyectod->calificacion_foro}}        --}}
            </td> 
              <td> 
                    <a class="btn btn-info btn-xs" href="{{ route('proyectoscambios',['id_pro' => $obtener->id_proyecto ] ) }}">ver detalles</a>
                    </td>
                     
         </tr>
            @endforeach 



<tr>
            
    </tbody>
  </div>
</div>
@endsection