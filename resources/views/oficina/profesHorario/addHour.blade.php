@extends('oficina.oficina')

@section('content')



<div class="panel-heading bg-primary">{{$docente->nombre}} </div>
<div class="panel-body">
    <form method="POST" action="/addHourDocente/{{$docente->id}}" class="form-center">
        {{csrf_field()}}
        <div class="form-group">
            <input type="date" name="fecha[]">
            <input type='time' class="name" name="h_entrada[]" min="07:00:am " max="16:00:pm" />
            <input type='time' class="name" name="h_salida[]" min="07:00:am " max="16:00:pm" />            
            <input type="date" name="fecha[]">
            <input type='time' class="name" name="h_entrada[]" min="07:00:am " max="16:00:pm" />
            <input type='time' class="name" name="h_salida[]" min="07:00:am " max="16:00:pm" />            
        </div>
        <button type="submit" class="btn btn-primary" value="Registrar" name="">Asignar hora</button>
        {!! $errors->first('password','<span class="help-block">:message</span>')!!}
    </form>
</div>

<script type="text/javascript">
    $(function() {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });
</script>
@endsection