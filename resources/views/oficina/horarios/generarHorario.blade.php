@extends('oficina.oficina')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/generarHorario" method="POST">
            {{ csrf_field() }}
            @if (Session::has('message'))
            <div class="alert alert alert-danger" id="alert-fade">({{ Session::get('message') }})</div>
            @endif
            <div class="row">
                <div class="form-group col-md-4 col-xl-2 ">
                    <label for="alpha">Alfa</label>
                    <input type="number" step="any" name="alpha" class="form-control">
                    @if ($errors->has('alpha'))
                    <span class="text-danger">{{ $errors->first('alpha') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-xl-2">
                    <label for="alpha">Beta</label>
                    <input type="number" name="beta" class="form-control">
                    @if ($errors->has('beta'))
                    <span class="text-danger">{{ $errors->first('beta') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-xl-2">
                    <label for="Q">Q</label>
                    <input type="number" name="Q" class="form-control">
                    @if ($errors->has('q'))
                    <span class="text-danger">{{ $errors->first('q') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-xl-3">
                    <label for="evaporation">Factor de evaporación</label>
                    <input type="number" name="evaporation" class="form-control">
                    @if ($errors->has('evaporation'))
                    <span class="text-danger">{{ $errors->first('evaporation') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-xl-3">
                    <label for="iterations">Número de iteraciones</label>
                    <input type="number" name="iterations" class="form-control">
                    @if ($errors->has('iterations'))
                    <span class="text-danger">{{ $errors->first('iterations') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-xl-3">
                    <label for="ants">Número de hormigas</label>
                    <input type="number" name="ants" class="form-control">
                    @if ($errors->has('ants'))
                    <span class="text-danger">{{ $errors->first('ants') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-xl-3">
                    <label for="estancado">Número de estancamiento</label>
                    <input type="number" name="estancado" class="form-control">
                    @if ($errors->has('estancado'))
                    <span class="text-danger">{{ $errors->first('estancado') }}</span>
                    @endif
                </div>
                <div class="form-group  col-md-4 col-xl-3">
                    <label for="t_max">Limite superior(valor inicial)</label>
                    <input type="number" name="t_max" class="form-control">
                    @if ($errors->has('t_max'))
                    <span class="text-danger">{{ $errors->first('t_max') }}</span>
                    @endif
                </div>
            </div>
            <!-- <div class="row">
            <div class="form-group col-md-6 col-xl- 3">
                <label for="ants">Número de hormigas</label>
                <input type="number" name="ants" class="form-control">
            </div>
           
            
        </div> -->
            <button type="submit" class="btn btn-sm btn-primary" id="generarHorario">Generar horario</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

<script>
    // $("#generarHorario").on('click', function() {        
    //     var alpha = $('input[name="alpha"]');        
    //     $(".loaderContainer").addClass('active');
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('input[name="_token"]').val()
    //         },
    //         type: 'post',
    //         url: '/generarHorario',
    //         data: {                
    //             alpha : alpha
    //         },
    //         success: function(data) {
    //             $(".loaderContainer").removeClass('active');              
    //         },
    //         error: function() {
    //             $(".loaderContainer").removeClass('active');               
    //         }
    //     });
    //});
</script>
@endsection