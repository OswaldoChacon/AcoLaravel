$(document).on('click','.btnEditar',function(){
    var element = $(this);
    $(this).addClass('none');
    element.parent().find('.btnAsignar').removeClass('none');
    element.parent().find('.btnCancelar').removeClass('none');
    element.parent().parent().find('input[name="inicio"]').prop('disabled',false);
    element.parent().parent().find('input[name="termino"]').prop('disabled',false);
});
$(document).on('click','.btnCancelar',function(){
    var element = $(this);
    $(this).addClass('none');
    element.parent().find('.btnAsignar').addClass('none');
    element.parent().find('.btnEditar').removeClass('none');
    element.parent().parent().find('input[name="inicio"]').prop('disabled',true);
    element.parent().parent().find('input[name="inicio"]').val('');
    element.parent().parent().find('input[name="termino"]').prop('disabled',true);
    element.parent().parent().find('input[name="termino"]').val('');
});
$(document).on('click','.btnAsignar',function(){
    var element = $(this);
    var inputValido = true;
    var token = $(this).parent().find('input[name="_token"]').val();
    console.log(token);
    /* Obteniendo valores de fecha */
    var idDocente = $(this).attr('id-docente');
    var arrayFechaForo = [];
    var arrayFechaInicio = [];
    var arrayFechaTermino = [];

    /* contenedores */
    var fechaForosElements = $(this).parent().parent().find('.fechaForoContainer p');
    var fechaInicioElements = $(this).parent().parent().find('.fechaInicioContainer input');
    var fechaTerminoElements = $(this).parent().parent().find('.fechaTerminoContainer input');


    /* Validando si inicio está vacío */
    $.each(fechaInicioElements,function(){
        if($(this).val() == ""){
            inputValido = false;
            $(this).addClass('input-invalid');
            setTimeout(() => {
                $(this).removeClass('input-invalid');
            }, 3000);
        }
    });
    /* Validando si término está vacío */
    $.each(fechaTerminoElements,function(){
        if($(this).val() == ""){
            inputValido = false;
            $(this).addClass('input-invalid');
            setTimeout(() => {
                $(this).removeClass('input-invalid');
            }, 3000);
        }
    });
    if(inputValido){
        /* Obteniendo valores de fechasForos */
        $.each(fechaForosElements,function(){
            arrayFechaForo.push($(this).text());
        });
        /* Obteniendo valores de fechasInicio */
        $.each(fechaInicioElements,function(){
            arrayFechaInicio.push($(this).val());
        });
        /* Obteniendo valores de fechasTermino */
        $.each(fechaTerminoElements,function(){
            arrayFechaTermino.push($(this).val());
        });

        /* Envío a la base de datos */
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            type: 'post',
            url: '/profes-envia-horario',
            data: {'fechasForo': arrayFechaForo, 'fechasInicio': arrayFechaInicio, 'fechasTermino': arrayFechaTermino, 'idDocente': idDocente},
            success: function(){
                console.log("insertado en la bd correctamente");
                element.parent().parent().find('input[name="inicio"]').prop('disabled',true);
                element.parent().parent().find('input[name="termino"]').prop('disabled',true);
            }
        });
    }
});