@extends('oficina.oficina')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/generarHorarioAnt" method="POST">
            {{ csrf_field() }}
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
                    <input type="number" name="t_minDenominador" class="form-control" value="5">
                    @if ($errors->has('t_minDenominador'))
                    <span class="text-danger">{{ $errors->first('t_minDenominador') }}</span>
                    @endif
                </div>
            </div>        
            <button type="submit" class="btn btn-sm btn-primary " id="generarHorario">Generar horario</button>
        </form>
    </div>
    <!-- @yield('contentHorarioTable') -->
</div>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

<script>   
    // $(".btnGenerar").on('click', function() {
    //     var alpha = $('select[name="alpha"]').val();        
    //     $(".loaderContainer").addClass('active');
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('input[name="_token"]').val()
    //         },
    //         type: 'post',
    //         url: '/generarHorarioAnt',
    //         data: {
    //             alpha: alpha
    //         },
    //         success: function(data) {
    //             $(".loaderContainer").removeClass('active');
    //             alert(data.success);
    //         },
    //         error: function() {
    //             $(".loaderContainer").removeClass('active');
    //             alert("error");
    //             // $(".messageContainer").addClass('active');
    //             // $(".messageContainer .message .title p").text('¡Error!');
    //             // $(".messageContainer .message .description p").text('Ocurrió un error al intentar conectar al servidor. Inténtelo más tarde.');
    //             // setTimeout(() => {
    //             //     $(".messageContainer").removeClass('active');
    //             // }, 3000);
    //         }
    //     });
    // });
</script>
@endsection