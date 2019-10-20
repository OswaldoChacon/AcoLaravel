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
                    @foreach($jurado as $item)
                    <tr>
                        <td>
                            {{$item->id_docente}}
                        </td>
                        <td>
                            {{$item->nombre}}
                        </td>
                        <td>
                            @foreach($horarios as $itemB)
                            <ul class="list-unstyled components">
                                <li class="active">
                                    <a href="#horas-{{$itemB->id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Editar horarios de fecha {{$itemB->fecha}}</a>
                                    <ul class="collapse list-unstyled" id="horas-{{$itemB->id}}">
                                        @foreach ($horas as $h)
                                        <li>
                                            <input id-proyecto-foro="" style="width: 25px; height: 25px" type="checkbox" name="status" value="participa"> {{$h}}
                                        </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
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