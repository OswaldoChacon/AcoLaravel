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
                    @if(Session::has('mesage'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('mesage') }}</p>
                    @endif

                    @php
                    $cont = 0;
                    @endphp
                    {{csrf_field()}}
                    @foreach($jurado as $item)
                    @php
                    $posicion = 0;
                    @endphp
                    <tr>
                        <td>
                            {{$item->id_docente}}
                        </td>
                        <td>
                            {{$item->nombre}}
                        </td>
                        <td>

                            @foreach($horarios as $key => $itemB)
                            <ul class="list-unstyled components">
                                <li class="">
                                    <a href="#horas-{{$cont + 1}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Editar horarios de fecha {{$itemB->fecha}}</a>
                                    <ul class="collapse list-unstyled" id="horas-{{$cont + 1}}">

                                        @php
                                        for($i = 0; $i < count($intervalosContainer); $i++){ if($key==$i){ for($j=0; $j < count($intervalosContainer[$i]) ; $j++ ){
                                            $horaExistente=false;
                                            $horaB = false;
                                            @endphp

                                            @foreach($horariosdocentes as $itemC)
                                            @php if($itemC->hora == $intervalosContainer[$i][$j] && $itemB->id == $itemC->id_horarioforos && $item->id_docente == $itemC->id_docente){
                                            $horaExistente = true;
                                            }
                                            @endphp

                                            @endforeach
                                            @foreach($posicionbreak as $itemD)
                                            @php if($itemD->horariobreal == $intervalosContainer[$i][$j] && $itemB->id == $itemD->id_horarioforo){
                                            $horaB = true;
                                            }
                                            @endphp
                                            @endforeach
                                            <li>
                                                <div class="inputContainer" style="background-color: {{$horaB == false ? ''  : '#ffcdd2' }}; width: 180px; height: 26px;">
                                                    <input {{$horaExistente == false ? '' : 'checked'}}

                                                    {{$horaB == false ? ''  : 'disabled' }} posicion="{{$posicion}}"
                                                    class="checkHorarioJurado" id-docente="{{$item->id_docente}}"
                                                    id-horario-foros="{{$itemB->id}}" style="width: 25px; height: 25px;"
                                                    type="checkbox" name="status" value="participa">
                                                    <small>{{$intervalosContainer[$i][$j]}}</small>

                                                </div>
                                            </li>
                                            @php
                                            $posicion++;
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
    </div>
</div>
@endsection
@push('asignarHorarioJurado')
<script src="{{asset('js/setHJurado.js')}}"></script>
@endpush
