@extends('alumno.alumno')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Solicitud de baja de un alumno</strong></center>
    </h3>
</div>
   <h4 class="panel-title">Por medio del presente solicito que se me de de baja del proyecto siguiente:</h4>
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

                 <tr>
                    <th>Empresa</th>
                   <td>{{$proyectos->nombre_de_empresa}}</td>
                    {{-- <th>{{$proyectoForo->titulo}}</th> --}}
                </tr>

                  <tr>
                    <th>Asesor Actual</th>
                    <td> {{$asesorP->prefijo}}. {{$asesorP->nombre}} {{$asesorP->paterno}} {{$asesorP->materno}} </td>
                    {{-- <th>{{$proyectoForo->id_foro}}</th> --}}
                    
                </tr>
              
            </thead>
            
    </div>

    <div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 100px;">
            <thead>
                <h3 class="panel-title">Alumno Solicitante:</h3>
                
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


<table class="table table-bordered">
        {{-- <thead> --}}

            <div class="col-md-6">
                <table class="table table-bordered" style="width: 750px;height: 100px;">
                   
                     <thead>
                        <tr>
                            <th> <label for="asesorN" >Situacion del proyecto</label> </th>
                            <th> <textarea class="form-control" 
				                        	type="text" 
					                        name="tituloN" 
					                        placeholder="Ingresa el nuevo titulo">
                                 </textarea> 
                         </th>
                            
                        </tr>
                        <tr>
                             <th> <label for="asesorN" >Motivo de baja del proyecto</label> </th>
                            <th> <textarea class="form-control" 
				                        	type="text" 
					                        name="motivoS" 
					                        placeholder=" Describe el motivo ">
                                 </textarea> 
                         </th>
                        </tr>

                        <tr>
                            <th>Documento Anexar</th>
                            <th> <input type="file" class="form-control" name="docSolicitud" ></th>
                            
              </div>
                        </tr>
                    </thead>
            </div>

       


            <div class="col-md-6">
                <table class="table table-bordered" style="width: 750px;height: 100px;">

                   <a href="/cancelar/{{Crypt::encrypt(Auth::guard('alumnos')->user()->id)}}">
                    <button class="btn btn-success btn-xs bnt-block">Solicitar</button>
                    <button class="btn btn-success btn-xs bnt-block">Cancelar</button>
                    </a>


            </div>
 </table>
          
            @endsection
