@extends('oficina.oficina')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="card col-xl-4 col-md-5">
      <div class="card-header">
        <h5 class="card-title">Registrar linea de investigación</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('lineaDeInvetigacionguardar') }}" class="form-center">
          {{csrf_field()}}
          @if (Session::has('message'))
          <div class="alert alert alert-danger">({{ Session::get('message') }})</div>
          @endif
          @if (Session::has('message1'))
          <div class="alert alert alert-info">({{ Session::get('message1') }})</div>
          @endif
          <div class="form-group ">

            <label for="name">Clave</label>
            <input class="form-control" type="text" name="clave" placeholder='Clave'>
            {!! $errors->first('clave','<span class="help-block alert alert-danger">:message</span>')!!}


            <label for="name">Nombre</label>
            <input class="form-control" type="text" name="linea" placeholder='Lineas de Investigacion'>
            {!! $errors->first('linea','<span class="help-block alert alert-danger">:message</span>')!!}
          </div>
          <button type="submit" class="btn btn-primary" value="Registrar" name="">Registarar</button>
        </form>
      </div>
    </div>




    <div class="card col-xl-7 col-md-6">
      <div class="card-header">
        <h5 class="panel-title">Lineas de Investigacion: <span style="font-weight: bold">{{$lineadeinvestigacion->count()}}</span></h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>Clave</th>
              <th>Nombre</th>
            </thead>
            <tbody>
              @foreach ($lineadeinvestigacion as $linea)
              <tr>
                <td>{{$linea->clave}}</td>
                <td>{{$linea->linea}}</td>
              </tr>
              @endforeach
            </tbody>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection