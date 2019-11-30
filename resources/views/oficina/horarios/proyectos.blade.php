@extends('oficina.oficina')

@section('content')
<style>
    li:hover {
        /* background: blue; */

    }

    a:active {
        background-color: blue;
    }

    .itemsHours {
        background: #DEDEDE;
    }
</style>
<div class="card">
    <h5 class="card-header">Proyectos participantes ({{count($proyectos)}})</h5>
    <div class="card-body">
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <th>Folio</th>
                    @for($i = 0; $i< sizeof($proyectos[0]->maestroList); $i++)
                        <th>Maestro</th>
                        @endfor
                        <!-- <th>c</th>
                    <th>d</th> -->
                        <th><span>Esp. de tiempo en común</span></th>
                </thead>
                <tbody>
                    @foreach($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->id}}</td>
                        <!-- <td>{{$proyecto->name}}</td> -->
                        @foreach($proyecto->maestroList as $key => $maestro)
                        <!-- <td>{{$maestro->nombre}}</td> -->
                        <td>
                            <ul class="list-unstyled components">
                                <li>
                                    {{$maestro->nombre}} ({{count($maestro->horario)}})
                                </li>
                                @foreach($intervalosContainer as $keyFechas => $horas)
                                <!-- <ul class="list-unstyled components"> -->
                                <li class="itemsHours">
                                    <!-- {{$keyFechas}} -->
                                    <a href="#posicion-{{$proyecto->id}}-{{$key}}-{{$keyFechas}}" data-toggle="collapse" aria-expanded="false">Fecha: &nbsp;{{$keyFechas}}</a>
                                    <ul class="collapse list-unstyled" id="posicion-{{$proyecto->id}}-{{$key}}-{{$keyFechas}}">
                                        @foreach($horas as $keyHoras => $hoursItem)
                                        @foreach($maestro->horario as $itemHorarios)
                                        @if($keyHoras == $itemHorarios)
                                        <li>
                                            <!-- <div class="container"> -->
                                            <span>{{$hoursItem}}</span>
                                            <!-- </div> -->
                                        </li>
                                        @endif
                                        @endforeach
                                        @endforeach
                                        <!-- </ul> -->
                                </li>
                            </ul>
                            @endforeach
                            </ul>
                        </td>
                        @endforeach
                        <td colspan="5">
                            <ul class="list-unstyled components">
                                <li>
                                    <!-- {{$maestro->nombre}} ({{count($maestro->horario)}}) -->
                                    <!-- <span>Esp. de tiempo en comunsssssssssssssss</span> -->
                                    <span>Cantidad: {{count($proyecto->espaciosComun)}}</span>
                                </li>
                                @foreach($intervalosContainer as $keyFechas => $horas)
                                <!-- <ul class="list-unstyled components"> -->
                                <li class="list-unstyled components">
                                    <!-- {{$keyFechas}} -->
                                    <a class="itemsHours" href="#posicion-{{$proyecto->id}}-{{$keyFechas}}" data-toggle="collapse" aria-expanded="false">Fecha: &nbsp;{{$keyFechas}}</a>
                                    <ul class="collapse list-unstyled" id="posicion-{{$proyecto->id}}-{{$keyFechas}}">
                                        @foreach($horas as $keyHoras => $hoursItem)
                                        @foreach($proyecto->espaciosComun as $espaciosComunItems)

                                        @if($keyHoras == $espaciosComunItems)
                                        <li>
                                            <!-- <div class="container"> -->
                                            <span>{{$hoursItem}}</span>
                                            <!-- </div> -->
                                        </li>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </ul>
                                </li>
                                <!-- </ul> -->
                                @endforeach
                            </ul>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- <script src="{{asset('js/jquery.js')}}"></script> -->
@endsection