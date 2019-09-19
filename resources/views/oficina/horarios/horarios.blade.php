@extends('oficina.oficina')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Asignar horarios a foros</h5>
    </div>
    <div class="card-body">
        <select class="form-control">
            <option> Elige foro</option>
            @foreach($foros as $foro)
            <option>{{$foro->noforo}}</option>
            @endforeach
        </select>
        hhhh  aaaaaaaaaaaaaaa
    </div>
</div>
@endsection
