@extends('oficina.oficina')

@section('content')

<div class="card">
   <div class="card-header">
      <h5 class="card-title">Crear foro</h5>
   </div>
   <div class="card-body">
      @if (Session::has('message'))
      <div class="alert alert alert-danger">{{ Session::get('message') }}</div>
      @endif
      <form method="post" action="{{ route('guardarForo') }}" class="form-center">
         {{csrf_field()}}
         <div class="form-group">

            <label for="name">Numero</label>
            <input class="form-inline" type="text" name="noforo" inputmode="Numero de  foro ">
            {!! $errors->first('noforo','<span class="help-block alert alert-danger">:message</span>')!!}

            <label for="name">Titulo</label>
            <input class="form-inline" type="text" name="titulo" value="FORO DE PROPUESTAS DE PROYECTOS PARA TITULACIÓN INTEGRAL" style="width:60%;">
            {!! $errors->first('titulo','<span class="help-block alert alert-danger">:message</span>')!!}
         </div>
         <div class="form-horizontal">
            <select class="form-center" name="periodo">
               <option value="" disabled selected>Perido</option>
               <option value="Agosto-Diciembre">Agosto-Diciembre</option>
               <option value="Enero-Junio">Enero-Junio</option>
            </select>
            {!! $errors->first('periodo','<span class="help-block alert alert-danger">:message</span>')!!}
            <select class="form-center" name="anoo">
               <option disabled selected>Año</option>
               @foreach (range(2018,2050) as $a)
               <option value="{{$a}}">{{$a}}</option>
               @endforeach
            </select>
            {!! $errors->first('anoo','<span class="help-block alert alert-danger">:message</span>')!!}

         </div>
         <br>
         <button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>
      </form>
   </div>
</div>



@endsection