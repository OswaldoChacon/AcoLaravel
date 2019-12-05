@extends('oficina.oficina')

@section('content')
@if (Session::has('message'))
<div class="alert alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card">
  <h5 class="card-header">Foros</h5>
  <div class="card-body">

    @foreach ($foro as $for)
    @if ($for->acceso==1)
    <div class="alert alert alert-warning">
      <tr>
        <td> Foro activado:
          {{$for->noforo}}
        </td>
      </tr>
    </div>
    @endif
    @endforeach

    <h5 class="panel-title">Foros: <span style="font-weight: bold">{{$foro->count()}}</span></h5>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <th>Numero </th>
          <th>Titulo</th>
        </thead>
        <tbody>
          @foreach ($foro as $for)
          <tr style="background-color: {{$for->acceso == 1 ? '#00b963' : '#e8e8e8'}}">
            <td>{{$for->noforo}}</td>
            <td>{{$for->titulo}}</td>
            <td>
              <?php
              $conteo = 0;
              foreach ($foro as $foroitem) {
                if ($foroitem->acceso == 1)
                  $conteo++;
              }
              if ($for->acceso == 1 && $conteo == 1) {
                ?>
                <a method="POTS" href="/desactivar/{{Crypt::encrypt($for->id)}}">
                  <button title="Finalizar foro" class="btn btn-danger btn-sm bnt-block"><i class="fas fa-power-off"></i></button>
                </a>
                <button title="Configurar foro" class="btn btn-success btn-sm bnt-block" onclick="location.href='configurarForo/{{Crypt::encrypt($for->id)}}'"><i class="fas fa-cogs"></i></button>
                <?php
                } elseif ($conteo == 0) {
                  $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                  $fechas_foro = explode("-", $for->periodo);
                  $mes_actual = date("m");
                  if (array_search($fechas_foro[0], $meses) + 1 <= $mes_actual && $mes_actual <= array_search($fechas_foro[1], $meses) + 1 &&  date("Y") <= $for->anoo) {
                    ?>
                  <a method="POTS" href="/activar/{{Crypt::encrypt($for->id)}} ">
                    <button title="Iniciar foro" class="btn btn-success btn-sm bnt-block"><i class="fas fa-power-off"></i></button>
                  </a>
              <?php
                }
              }
              ?>
              <?php


              ?>

              <?php
              // }
              ?>
              <button title="Proyectos" class="btn btn-info btn-sm bnt-block" onclick="location.href='proyecto/{{Crypt::encrypt($for->id)}}'"><i class="fas fa-book"></i></button>
              <a title="Eliminar foro" href="/eliminarForo/{{$for->id}}" class="btn btn-danger btn-sm btnbreak"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>        
    </div>
  </div>
</div>
@endsection