@extends('oficina.oficina')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.1/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/file-saver@2.0.2/dist/FileSaver.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
<div class="card">
    <div class="card-body">
        <!-- <form action="/generarHorarioAnt" method="POST" id="ant"> -->
        <!-- {{ csrf_field() }} -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (Session::has('message'))
        <div class="alert alert alert-danger" id="alert-fade">({{ Session::get('message') }})</div>
        @endif
        <div class="row">
            <div class="form-group col-md-4 col-xl-2 ">
                <label for="alpha">Alfa</label>
                <input type="number" step="any" name="alpha" class="form-control" value="1">
                @if ($errors->has('alpha'))
                <span class="text-danger">{{ $errors->first('alpha') }}</span>
                @endif
            </div>
            <div class="form-group col-md-4 col-xl-2">
                <label for="alpha">Beta</label>
                <input type="number" name="beta" class="form-control" value="2">
                @if ($errors->has('beta'))
                <span class="text-danger">{{ $errors->first('beta') }}</span>
                @endif
            </div>
            <div class="form-group col-md-4 col-xl-2">
                <label for="Q">Q</label>
                <input type="number" name="Q" class="form-control" value="50">
                @if ($errors->has('Q'))
                <span class="text-danger">{{ $errors->first('Q') }}</span>
                @endif
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="evaporation">Factor de evaporación</label>
                <input type="number" name="evaporation" class="form-control" value="0.1">
                @if ($errors->has('evaporation'))
                <span class="text-danger">{{ $errors->first('evaporation') }}</span>
                @endif
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="iterations">Número de iteraciones</label>
                <input type="number" name="iterations" class="form-control" value="1">
                @if ($errors->has('iterations'))
                <span class="text-danger">{{ $errors->first('iterations') }}</span>
                @endif
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="ants">Número de hormigas</label>
                <input type="number" name="ants" class="form-control" value="1">
                @if ($errors->has('ants'))
                <span class="text-danger">{{ $errors->first('ants') }}</span>
                @endif
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="estancado">Número de estancamiento</label>
                <input type="number" name="estancado" class="form-control" value="1">
                @if ($errors->has('estancado'))
                <span class="text-danger">{{ $errors->first('estancado') }}</span>
                @endif
            </div>
            <!-- <div class="form-group  col-md-4 col-xl-3">
                    <label for="t_max">Limite superior(valor inicial)</label>
                    <input type="number" name="t_max" class="form-control">
                    @if ($errors->has('t_max'))
                    <span class="text-danger">{{ $errors->first('t_max') }}</span>
                    @endif
                </div> -->
            <div class="form-group  col-md-4 col-xl-3">
                <label for="t_minDenominador">t_minDenominador</label>
                <input type="number" name="t_minDenominador" class="form-control" id="test" value="5">
                @if ($errors->has('t_minDenominador'))
                <span class="text-danger">{{ $errors->first('t_minDenominador') }}</span>
                @endif
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-primary " id="generarHorario">Generar horario</button>
        <!-- </form> -->
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="horarioGenerado">
                <thead>
                    <tr>
                        <?php
                        echo ('<th>Fecha</th>');
                        for ($z = 0; $z < $salones; $z++) {
                            echo ('<th>Clave</th>');
                            for ($y = 0; $y < $maestrosTable; $y++) {
                                echo ('<th>Maestro</th>');
                            }
                            echo ('<th></th>');
                        }
                        ?>
                    </tr>
                </thead>
                <tbody style="table-layout:fixed">

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<!-- @push('hour') -->
<!-- <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script> -->
<script>
    $("#generarHorario").on('click', function() {
        var alpha = $('input[name="alpha"]').val();
        var beta = $('input[name="beta"]').val();
        var Q = $('input[name="Q"]').val();
        var evaporation = $('input[name="evaporation"]').val();
        var iterations = $('input[name="iterations"]').val();
        var ants = $('input[name="ants"]').val();
        var estancado = $('input[name="estancado"]').val();
        var t_minDenominador = $('input[name="t_minDenominador"]').val();
        // alert(t_minDenominador);

        // var beta 
        // var form = $('#ant').serialize()
        $(".loaderContainer").addClass('active');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/generarHorarioAnt',
            data: {
                alpha: alpha,
                beta: beta,
                Q: Q,
                evaporation: evaporation,
                iterations: iterations,
                ants: ants,
                estancado: estancado,
                t_minDenominador: t_minDenominador

            },
            success: function(data) {
                $(".loaderContainer").removeClass('active');
                // alert(data["2019-11-04 08:00:00 - 08:30:00"]);        
                $('table').before('<button type="button" class="btn-sm btn-primary" id="btn">Descargar horario</button>');
                // $( ".inner" ).before( "<p>Test</p>" );
                var tableHour = '';
                // tableHour +='<button type="button" class="btn-sm btn-primary" id="btn">Descargar horario</button>'
                $.each(data, function(key, lastkey) {
                    // $(".horarioGenerado tbody").append(`
                    // <tr>
                    // <td>
                    // ${key}
                    // </td>
                    // <td>                    
                    // `);
                    // console.log(data[key]);
                    // alert(data[key]);
                    tableHour += '<tr>';
                    tableHour += '<td>' + key + '</td>';
                    $.each(data[key], function(event, events) {
                        // alert(data[key]);
                        console.log(data[key][event]);
                        $.each(data[key][event], function(item, items) {
                            tableHour += '<td>' + data[key][event][item] + '</td>';
                            // console.log(data[key][event][item]);

                        });
                        tableHour += '<td></td>';
                    });
                    tableHour += '</tr>';
                });
                $("#horarioGenerado tbody").append(tableHour);
            },
            error: function() {
                $(".loaderContainer").removeClass('active');
                alert("error");
                // $(".messageContainer").addClass('active');
                // $(".messageContainer .message .title p").text('¡Error!');
                // $(".messageContainer .message .description p").text('Ocurrió un error al intentar conectar al servidor. Inténtelo más tarde.');
                // setTimeout(() => {
                //     $(".messageContainer").removeClass('active');
                // }, 3000);
            }
        });
    });
    var wb = XLSX.utils.table_to_book(document.getElementById('horarioGenerado'), {
        sheet: "horarios"
    });
    var wbout = XLSX.write(wb, {
        bookType: 'xlsx',
        bookSST: true,
        type: 'binary'
    });

    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    $("#btn").click(function() {
        saveAs(new Blob([s2ab(wbout)], {
            type: "application/octet-stream"
        }), 'horarios.xlsx');
    });
</script>
<!-- @endpush -->