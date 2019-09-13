@extends('oficina.oficina')

@section('content')
<script>
    function mostrar(id) {
        var objeto = document.getElementById(id)
        if (objeto.style.display == "block")
            objeto.style.display = "none";
        else
            objeto.style.display = "block";
    }
</script>
<style>
    .oculto {
        display: none;
    }
</style>

<input type="button" onclick="mostrar('contenido1')" value="Agregar Profesor">
<form class="oculto" id="contenido1" method="post" action="/agregarProfeAforoJurado/{{$user}}" class="form-center">
    {{csrf_field()}}
    <br>
    <select name="maestro">
        <option disabled selected class="dropdown-toggle">Profesores</option>
        @foreach($docente as $doc)
        <option value="{{$doc->id}}">{{$doc->prefijo}} {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary" value="Registrar" name="">Registarar</button>
</form>

@endsection