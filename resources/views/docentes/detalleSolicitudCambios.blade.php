@extends('docentes.docente')

@section('content')
<div class="card">
  <h5 class="card-header">
   <center><strong>Detalle de solicitud de cambio</strong></center>
  </h5>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
         <th><h4 class="panel-title">Id de Proyecto</h4></th>
            <th><h4 class="panel-title">Motivo</h4></th>
            <th><h4 class="panel-title">Tipo de cambio</h4></th>
            @foreach($datos as $obtener)
             <th><h4 class="panel-title">{{$obtener->id_proyecto}} </h4></th>
            
          
        </thead>
        <tbody>
    </div>
    
{{csrf_field()}}
<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Tipo de cambio </strong> </FONT> </label>
<br>
 <label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Id del proyecto: </strong> </FONT> </label>
<br>
<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Nombre del proyecto: </strong> </FONT> </label>
<br>
<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Solicitante </strong> </FONT> </label>
<br>
<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Motivo: </strong>  </FONT> {{$obtener->motivo}} </label>
<br>
 <label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Dato anterior </strong> </FONT> </label>
<br>
<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Dato Nuevo </strong> </FONT> </label>
<br>
 <label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Fecha de solicitud </strong> </FONT> </label>
<br>

    @endforeach 


    @endsection