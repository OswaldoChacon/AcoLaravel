
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


    <table class="table table-light table-hover" style="empty-cells" CELLSPACING="6" >

    <thead class="thead-light">
		<tr>
			<th><h4 class="panel-title">ETAPAS:</h4></th>
           <th> <h4 class="panel-title"> Estatus/Calificacion: </h4></th>
        </tr>
       
</thead>
 </table>

  <table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" >

    <thead class="thead-light">
  <tr>
			<th>Registro</th>
            <td name='idProyecto'>
            
            
                 <?php
                 if (empty($control->id_proyecto)) {
               echo "Null";
           } else {
                echo "Registrado";
                     }
                          ?>
            </td>
         <td><a class="list-group-item"  href="/registroIr/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                   Ver Detalles</a>
                   </td>
   </tr>
           </thead>
</table>


<table empty-cells:hide class="table table-bordered" style="width: 750px;height: 100px;" id="table0" >
            <thead class="thead-light">
 <tr> 

			  <tr>        
            <th>Foro</th>        
            <td>
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
			<th>Seminario</th>
            
             <td name='seminario'>
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

            <th>Recidencia</th>     
            <td>Inabilitada</td>     
            <td>
        		 <a class="list-group-item" href="/solicitarResidencia/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                
                    Solicitar
                    </a>        
                             
            
            </td> 
         
</tr>
</thead>
 </table>







    <table class="table table-bordered">
        {{-- <thead> --}}


            <div class="col-md-6">
                <table class="table table-bordered" style="width: 750px;height: 100px;">
                   
                    {{-- <label name='idsolicitante'>{{Auth::guard('alumnos')->user()->id}}</label> --}}
                   

                   <a href="/cancelar/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                    <button class="btn btn-success btn-xs bnt-block">Salir</button>
                    </a>


            </div>
 </table>
          


            @endsection



 
