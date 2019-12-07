@extends('oficina.oficina')

@section('content')
<!-- <div class="container-fluid"> -->
<div class="row">
  <div class="card col-xl-4 col-md-5">
    <h5 class="card-header">Registrar linea de investigación</h5>
    <div class="card-body">
      <form method="post" action="{{ route('lineaDeInvetigacionguardar') }}" class="form-center">
        {{csrf_field()}}
        @if (Session::has('success'))
        <div class="alert alert alert-success" id="alert-fade">({{ Session::get('success') }})</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert alert-danger" id="alert-fade">({{ Session::get('error') }})</div>
        @endif
        <div class="form-group ">
          <label for="name">Clave</label>
          <input class="form-control" type="text" name="clave" placeholder='Clave'>
          @if ($errors->has('clave'))
          <span class="text-danger">{{ $errors->first('clave') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="name">Nombre</label>
          <input class="form-control" type="text" name="nombre" placeholder='Lineas de Investigacion'>
          @if ($errors->has('linea'))
          <span class="text-danger">{{ $errors->first('nombre') }}</span>
          @endif
        </div>
        <button type="submit" class="btn btn-primary btn-sm" value="Registrar" name="">Registrar</button>
      </form>
    </div>
  </div>




  <div class="card col-xl-7 col-md-6">
    <h5 class="card-header">Lineas de Investigacion: <span style="font-weight: bold">{{$lineadeinvestigacion->count()}}</span></h5>
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
              <td><a href="{{url('/LineaDeInvestigacioneliminar/'.Crypt::encrypt($linea->id)) }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a></td>                            
            </tr>
            @endforeach
          </tbody>
      </div>
    </div>
  </div>
</div>
<!-- </div> -->

<script src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
@endsection