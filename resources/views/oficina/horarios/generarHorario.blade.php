@extends('oficina.oficina')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

<div class="card">
    <div class="card-body">
        <form action="/generarHorarioAnt" method="POST">
        @csrf
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        @if (Session::has('message'))
        <div class="alert alert alert-danger" id="alert-fade">({{ Session::get('message') }})</div>
        @endif
        <div class="row">
            <div class="form-group col-md-4 col-xl-2 ">
                <label for="alpha">Alfa</label>
                <input type="number" step="any" name="alpha" class="form-control" value="1">
            </div>
            <div class="form-group col-md-4 col-xl-2">
                <label for="alpha">Beta</label>
                <input type="number" name="beta" class="form-control" value="2">
            </div>
            <div class="form-group col-md-4 col-xl-2">
                <label for="Q">Q</label>
                <input type="number" name="Q" class="form-control" value="1">
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="evaporation">Factor de evaporación</label>
                <input type="number" name="evaporation" class="form-control" value="0.1">
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="iterations">Número de iteraciones</label>
                <input type="number" name="iterations" class="form-control" value="2">
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="ants">Número de hormigas</label>
                <input type="number" name="ants" class="form-control" value="5">
            </div>
            <div class="form-group col-md-4 col-xl-3">
                <label for="estancado">Número de estancamiento</label>
                <input type="number" name="estancado" class="form-control" value="5">
            </div>
            <div class="form-group  col-md-4 col-xl-3">
                <label for="t_minDenominador">t_minDenominador</label>
                <input type="number" name="t_minDenominador" class="form-control" id="test" value="5">
            </div>
        </div>
        <!-- <button type="button" class="btn btn-sm btn-primary " id="generarHorario">Generar horario</button>         -->
        <button type="submit" class="btn btn-sm btn-primary " id="generarHorari">Generar horario</button>
        </form>
        <div class="container no-content" style="margin-top:10px; ">
        <!-- <div class="remove">

        </div> -->
        </div>
    </div>
</div>


<div class="table-responsive">
    <table class="table" id="horarioGenerado">
        <thead>
            <tr>
                <?php
                echo ('<th>Fecha</th>');
                echo ('<th>Hora</th>');
                for ($z = 0; $z < $salones; $z++) {
                    echo ('<th>Clave</th>');
                    for ($y = 0; $y < $maestrosTable; $y++) {
                        echo ('<th>Maestro</th>');
                    }
                }
                echo ('<th class="not-export">Violaciones de restricciones suaves</th>')
                ?>
            </tr>
        </thead>
        <tbody id="myTableBody" style="table-layout:fixed">
        </tbody>
    </table>
</div>
@endsection



@push('generarHorario')


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.colVis.min.js"></script>


<script>
    // var salones = {{$salones}};
    // var maestros = {{$maestrosTable}} + 1;
    //  console.log(maestros);
    var columns = document.getElementById('horarioGenerado').rows[0].cells.length
    $("#generarHorario").on('click', function() {
        $('div').remove('.remove');
        var alpha = $('input[name="alpha"]').val();
        var beta = $('input[name="beta"]').val();
        var Q = $('input[name="Q"]').val();
        var evaporation = $('input[name="evaporation"]').val();
        var iterations = $('input[name="iterations"]').val();
        var ants = $('input[name="ants"]').val();
        var estancado = $('input[name="estancado"]').val();
        var t_minDenominador = $('input[name="t_minDenominador"]').val();
        var salones = $('input[name="salones"]').val();
        var maestrosTable = $('input[name="maestrosTable"]').val();
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
                if(data==null)     {
                    $('.no-content').after('<div class="remove"><span class="text-danger">Existe al menos un proyecto que no contiene espacios en comun entre los maestros</span><a href="proyectos" class="btn-primary btn-sm btn">Ver eventos</a></div>');
                }                
                // console.log(data_aux);
                // console.log(data.shift());
                // $.each(data, function(key, lastkey) {
                //     if([key] ==0){                    
                //     alert(key);
                //      delete data[key];
                //     }                   
                // });                                               
                $(".loaderContainer").removeClass('active');
                var tableHour = '';
                $.each(data, function(date, dates) {      
                    // alert(data[date]);                                       
                    tableHour += '<tr>';                
                    tableHour += '<td colspan="'+columns+'">'+date+'</td>';                    
                    for (var z = 0; z < columns-1; z++) {                                
                        tableHour += '<td style="display:none"></td>';                                
                    }                                         
                    tableHour += '</tr>';
                    // console.log(data[date]);
                    $.each(data[date],function(hour,hours){                                 
                        tableHour += '<tr>';
                        tableHour += '<td></td>';
                        tableHour += '<td>' + hour + '</td>';
                        // console.log(data[date][hour]);                                                
                        $.each(data[date][hour], function(event, events) {                            
                            // console.log(data[date][hour][event]);
                            // alert(data[date][hour][event]);
                            // alert(event);
                            if (data[date][hour][event].length == 0) {
                                for (var z = 0; z < {{$maestrosTable}}+1; z++) {
                                    tableHour += '<td></td>';
                                }                            
                            }                            
                            $.each(data[date][hour][event], function(item, items) {                                
                                tableHour += '<td>' + data[date][hour][event][item] + '</td>';
                            });
                        });
                        tableHour += '</tr>';
                    });     
                    // for (var z = 0; z < 2; z++) {                                
                    //     tableHour += '<tr>';                                                
                    //     for (var y = 0; y < columns; y++) {                             
                    //         tableHour += '<td></td>';                                
                    //     }   
                    //     tableHour += '</tr>';
                    // }                                                       
                });                
                var table = $('#horarioGenerado').DataTable({
                    "language": {
                        "emptyTable": "No se ha podido cargar el horario"
                    },
                    destroy: true,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "searching": false,
                    "autoWidth": true,
                    dom: 'Bfrtip',
                    "aoColumnDefs": [{
                        "aTargets": ['_all'],
                        "bSortable": false
                    }],
                    // "columns": [],                    
                    buttons: [                           
                        {
                            extend: 'excelHtml5',
                            className: "btn btn-primary",                
                            messageTop: {{$maestrosTable}},
                            exportOptions: {
                                columns: ':visible'                                
                            }
                            // "bShowAll": true
                        },

                        {
                            extend: 'pdfHtml5',
                            messageTop: {{$maestrosTable}},
                            orientation: 'landscape',
                            exportOptions: {
                                // columns: [columns]
                                // columns: ':visible'
                                // columns: [ columns, ':false' ]
                                columns: ':visible:not(.not-export)'
                            }
                        },
                        {
                            extend:'colvis',
                            text: 'Ocultar columna'
                        },                 
                        {
                            extend:'copy',
                            text: 'Copiar'
                        },    
                    ]
                });
                table.clear();
                // $('#horarioGenerado').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
                table.rows.add($(tableHour)).draw();                
            },
            error: function(error) {
                $(".loaderContainer").removeClass('active');                
                console.log(error);
                var er = error.responseJSON.errors;                                
                // alert(error);
                console.log(er);
                $.each(er, function(name, message) {
                    $('input[name=' + name + ']').after('<span class="text-danger">' + message + '</span>');
                })
                // $(".messageContainer").addClass('active');
                // $(".messageContainer .message .title p").text('¡Error!');
                // $(".messageContainer .message .description p").text('Ocurrió un error al intentar conectar al servidor. Inténtelo más tarde.');
                // setTimeout(() => {
                //     $(".messageContainer").removeClass('active');
                // }, 3000);
            }
        });
    });
</script>

@endpush