@extends('oficina.oficina')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Seleccione proyectos participantes</h5>
    </div>

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
                        <button class="btn btn-success btn-xs bnt-block btnBuscarForos">Buscar</button>
                    </th>
                </thead>
                <thead>
                    <th>Folio</th>
                    <th>Título del proyecto</th>
                    <th>Participa</th>
                </thead>
                <tbody style="table-layout:fixed">

                </tbody>
        </div>
    </div>

</div>
@endsection
@push('participaControl')
<script>
    /* Procedimiento para mostrar proyectos por foro */
    $(".btnBuscarForos").on('click', function() {
        var idForo = $('select[name="foros"]').val();
        if(idForo == "seleccione"){
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
                    <td aling="center">
                        <input id-proyecto-foro="${this.id}" style="width: 22px; height: 22px" type="checkbox" name="status" value="participa" ${this.participa == 0 ? '' : 'checked' }>
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

    /* Procedimiento para actualizar que un proyecto participa */
    $(document).on('change', "input[type='checkbox']", function() {
        // alert($(this).attr('id-proyecto-foro'));
        $(".loaderContainer").addClass('active');
        var idProyectoForo = $(this).attr('id-proyecto-foro');
        var value = $(this).prop('checked') == true ? 1 : 0;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'post',
            url: '/horarios/edit-participa',
            data: {
                id: idProyectoForo,
                value: value
            },
            success: function() {
                $(".loaderContainer").removeClass('active');
                // $(".messageContainer").addClass('active');
                // $(".messageContainer .message .icon").html('');
                // $(".messageContainer .message .icon").append('<i class="fas fa-envelope"></i>');
                // $(".messageContainer .message .title p").text('¡Registro Actualizado!');
                // $(".messageContainer .message .description p").text('Su registro ha sido actualizado correctamente');
                // setTimeout(() => {
                //     $(".messageContainer").removeClass('active');
                // }, 1000);
            },
            error: function() {
                $(".loaderContainer").removeClass('active');
                // $(".messageContainer").addClass('active');
                // $(".messageContainer .message .icon").html('');
                // $(".messageContainer .message .icon").append('<i class="fas fa-envelope"></i>');
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
