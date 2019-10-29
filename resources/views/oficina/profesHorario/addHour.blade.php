@extends('oficina.oficina')

@section('content')

<div class="card">
    <h5 class="card-header">Horario del Jurado</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-docentes">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Horas disponibles</th>
                </thead>
                <tbody>
                    @php
                    $cont = 0;
                    @endphp
                    @foreach($jurado as $item)
                    <tr>
                        <td>
                            {{$item->id_docente}}
                        </td>
                        <td>
                            {{$item->nombre}}
                        </td>
                        <td>
                        {{csrf_field()}}
                        @foreach($horarios as $key => $itemB)
                        <ul class="list-unstyled components">
                            <li class="">
                                <a href="#horas-{{$cont + 1}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Editar horarios de fecha {{$itemB->fecha}}</a>
                                <ul class="collapse list-unstyled" id="horas-{{$cont + 1}}">

                                    @php
                                for($i = 0; $i < count($intervalosContainer); $i++){
                                    if($key == $i){
                                    for($j = 0; $j < count($intervalosContainer[$i]) ; $j++  ){
                                    @endphp
                                <li>
                                    <div class="inputContainer">
                                        <input class="checkHorarioJurado" id-docente="{{$item->id_docente}}" id-horario-foros="{{$itemB->id}}" style="width: 25px; height: 25px" type="checkbox" name="status" value="participa" >
                                        <small>{{$intervalosContainer[$i][$j]}}</small>
                                    </div>
                                </li>
                                    @php
                                    }
                                }
                                }
                                    @endphp

                                </ul>
                            </li>
                        </ul>
                        @php
                        $cont++;
                        @endphp
                        @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button style="text-align:right" class="btn btn-success btn-xs bnt-block">Guardar</button></h5>
    </div>
</div>
@endsection
@push('asignarHorarioJurado')
<script src="{{asset('js/setHJurado.js')}}"></script>
@endpush
