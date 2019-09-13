@extends('oficina.oficina')

@section('content')
<div class="card">  
  <div class="card-body">
    <h5 class="card-title">Registrar linea de investigación</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
  <div class="panel-heading">Area de conocimiento Registradas </div>
  <div class="panel-body">
    <form  method="post" action="{{ route('areadeconocimientoguardar') }}" class="form-center">
        {{csrf_field()}}
        <div class="form-group ">
    <select name="select">
                    <option  disabled selected class="dropdown-toggle">Lineas de Investigacion</option>
                    @foreach($lineadeinvestigacion as $linea)
                    <option value="{{$linea->linea}}">{{$linea->linea}}</option>
                    @endforeach
                </select>
  </div>
          <label for="name">Area de conocimiento</label>
          <input class="form-control" 
          type="text" 
          name="area" 
          placeholder='Area de conocimiento'>
          {!! $errors->first('area','<span class="help-block alert alert-danger">:message</span>')!!}
        </div>
        <button type="submit" class="btn btn-primary" value="Registrar" name="">Registarar</button>
   </form>
 </div>
  

  
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Area de conocimiento: <span style="font-weight: bold">{{$areadeconocimiento->count()}}</span></h3>
  </div>
  <div class="panel-body">
   <div class="table-responsive">
     <table class="table table-striped table-hover" >
  <thead>
    <th>Lineas de Investigacion </th>
    <th>Area de conocimiento</th>
  </thead>
  <tbody>
 @foreach ($areadeconocimiento as $area)
     <tr>
      <td>{{$area->linea}}</td>
      <td>{{$area->areade}}</td>
      <td>
       <a href="#" >Eliminar</a>
      </td>
    </tr>
 
  @endforeach 
      </tbody>

  </div>
</div>
   </div>
@endsection