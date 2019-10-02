@extends('docentes.docente')

@section('content')
 <div class="panel-heading">Alumno </div>
  <div class="panel-body">
<form method="post" action="{{route('dartokenAlumnoP')}}" class="form-center">
	{{ csrf_field() }}

 @if (Session::has('message'))
		<div class="alert alert alert-danger">No.Control existentes: ({{ Session::get('message') }})</div>
			@endif
			<select name="profe">
                    @foreach($doc as $docente)
                     @if ($docente->nombre==Auth::guard('docentes')->user()->nombre)
                    <option value="{{$docente->prefijo}}. {{$docente->nombre}} {{$docente->paterno}} {{$docente->materno}}">{{$docente->prefijo}} . {{$docente->nombre}} {{$docente->paterno}} {{$docente->materno}}</option>
                    @endif
                    @endforeach
                </select>

                <select name="grupo">
                    <option  disabled selected class="dropdown-toggle">Grupos</option>
                    <option value="GR-A ">GR-A </option>
                    <option value="GR-B">GR-B </option>
                    <option value="GR-C ">GR-C </option>
                    <option value="GR-C ">GR-D </option>
                </select>
	@foreach (range(1,$tokenN) as $token)
	<div class="form-group  {{ $errors->has('nocontrol')? 'has-error': ''}}">
    	<label for="nocontrol-{{$token}}">numero de control #{{$token}}</label>
					<input class="form-control" 
					type="text" 
					name="nocontrol[]"
					id="nocontrol-{{$token}}" 
					class="form-control"
					value="{{old('nocontrol[$token]')}}"
					placeholder='numero de control'>		
    </div>
    {!! $errors->first('nocontrol','<span class="help-block alert alert-danger">:message</span>')!!}
	@endforeach
	<button type="submit" class="btn btn-primary" value="Registrar" name="">Guardar</button>
	
</form>
</div>
@endsection
