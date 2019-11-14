@extends('oficina.oficina')

@section('content')

<div class="card">
   <h5 class="card-header">Crear foro</h5>
   <div class="card-body">
      @if (Session::has('message'))
      <div class="alert alert alert-danger">{{ Session::get('message') }}</div>
      @endif
      <form method="post" action="{{ route('guardarForo') }}" class="form-center">
         {{csrf_field()}}
         <div class="row">
            <div class="form-group col-md-2">
               <label for="name">Numero</label>
               <input class="form-control" type="text" name="noforo" inputmode="Numero de  foro ">
               <!-- {!! $errors->first('noforo','<span class="help-block alert alert-danger">:message</span>')!!} -->
               @if ($errors->has('noforo'))
               <span class="text-danger">{{ $errors->first('noforo') }}</span>
               @endif
            </div>
            <div class="form-group col-md-10">
               <label for="name">Titulo</label>
               <input class="form-control" type="text" name="titulo" value="FORO DE PROPUESTAS DE PROYECTOS PARA TITULACIÓN INTEGRAL">
               <!-- {!! $errors->first('titulo','<span class="help-block alert alert-danger">:message</span>')!!} -->
               @if ($errors->has('titulo'))
               <span class="text-danger">{{ $errors->first('titulo') }}</span>
               @endif
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <select class="form-control" name="periodo">
                  <option value="" disabled selected>Perido</option>
                  <option value="Agosto-Diciembre">Agosto-Diciembre</option>
                  <option value="Enero-Junio">Enero-Junio</option>
               </select>
               <!-- {!! $errors->first('periodo','<span class="help-block alert alert-danger">:message</span>')!!} -->
               @if ($errors->has('periodo'))
               <span class="text-danger">{{ $errors->first('periodo') }}</span>
               @endif
            </div>
            <div class="form-group col-md-6">
               <select class="form-control" name="anoo">
                  <option disabled selected>Año</option>
                  @foreach (range(2019,2050) as $a)
                  <option value="{{$a}}">{{$a}}</option>
                  @endforeach
               </select>
               <!-- {!! $errors->first('anoo','<span class="help-block alert alert-danger">:message</span>')!!} -->
               @if ($errors->has('anoo'))
               <span class="text-danger">{{ $errors->first('anoo') }}</span>
               @endif
            </div>
         </div>
         <br>
         <button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>
      </form>
   </div>
</div>



@endsection
