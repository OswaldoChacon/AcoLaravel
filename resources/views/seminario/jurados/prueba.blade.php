@extends('seminario.layout')

@section('content')

<div class="card">
    <h5 class="card-header">Segumiento De Proyectos</h5>
    <div class="card-body">
        <div class="table-responsive">
            {{csrf_field()}}
            <table class="table table-striped table-hover tableForos">
                <thead>
                    <th>
                        <select name="foros" class="form-control">
                            <option value="seleccione"> Elige foro</option>
                             @foreach($foros as $foro)
                            <option value="{{$foro->id}}">{{$foro->noforo}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <button class="btn btn-success btn-xs bnt-block btnBuscarForos">Buscar Proyectos</button>
                    </th>
                </thead>
                <thead>
                    <th>Folio</th>
                    <th>Título del proyecto</th>
                    <th>Acciones</th>
                </thead>
                <tbody style="table-layout:fixed">
                </tbody>
        </div>
    </div>

</div>
<div class="card-body">
<h5>Buscar Proyectos

{{-- {{ Form::open(['route' => 'user', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
<div class="form-group">
             {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'nombre']) }}
  </div>

<div class="form-group">
             {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'nombre']) }}
 
{{ Form::close() }} --}}

</h5>
 </div>

@endsection
@push('participaControl')
<script>
    /* Procedimiento para mostrar proyectos por foro */
    $(".btnBuscarForos").on('click', function() {
        var idForo = $('select[name="foros"]').val();
        if (idForo == "seleccione") {
            // $(".messageContainer").addClass('active');
            // $(".messageContainer .message .icon").html('');
            // $(".messageContainer .message .icon").append('<i class="fas fa-exclamation-triangle"></i>');
            // $(".messageContainer .message .title p").text('¡Atención!');
            // $(".messageContainer .message .description p").text('Debe seleccionar un foro antes');
            // setTimeout(() => {
            //     $(".messageContainer").removeClass('active');
            // }, 2000);
        }
        $(".loaderContainer").addClass('active');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'get',
            url: '/horarios/get-proyectos-foro-horario',
            data: {
                idForo: idForo
            },
            success: function(data) {
                $(".loaderContainer").removeClass('active');
                $(".tableForos tbody").html('');
                $.each(data, function(i, val) {
                    $(".tableForos tbody").append(`
                    <tr>
                    <td>
                        ${this.id}
                    </td>
                    <td>
                        ${this.titulo}
                    </td>
                  
                    <td>
                    <a class="btn btn-info btn-xs" href="/jurados/detallepro/${this.id}">Seguimiento de Proyecto</a>
                
                    </td>
                    </tr>
                    `);
                });
            },
            error: function() {
                $(".loaderContainer").removeClass('active');
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

