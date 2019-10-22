@extends('oficina.oficina')

@section('content')

<div class="card">
  <h5 class="card-header">Docentes registrados</h5>
  <div class="card-body">
    <h5>Cantidad de docentes: <span style="font-weight: bold">{{$profes->count()}}</span>
    </h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-docentes">
        <thead>
          <th>Matricula</th>
          <th>Nombre</th>
          <th>Correo</th>
        </thead>
        <tbody>

          @foreach ($profes as $profe)
          <tr>
            <td>{{$profe->matricula}}</td>
            <td>{{$profe->nombre}}</td>
            <td>{{$profe->email}}</td>                      
          </tr>
          @endforeach
        </tbody>
        <!-- <input type="time" class="inputTime" disabled><br> -->
      </table>
    </div>
  </div>
</div>

<!-- 
<script type="text/javascript">
  function deshabilitar(id, boton, boton2) {
    var objeto = document.getElementsByClassName(id)
    var buttons = document.getElementById(boton)
    var buttons2 = document.getElementById(boton2)
    if (objeto[0].disabled == true) {
      for (var i = 0; i < objeto.length; i++) {
        objeto[i].disabled = false;
      }
      // alert("esta bloqueado");
      buttons.style.display = "none"
      buttons2.style.display = "block"
    } else {
      for (var i = 0; i < objeto.length; i++) {
        objeto[i].disabled = true;
      }
      buttons.style.display = "block"
      buttons2.style.display = "none"
      // alert("no esta bloqueado");
    }
  }
</script> -->
@endsection
@push('srcProfesores')
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/profesores.js')}}"></script>
@endpush