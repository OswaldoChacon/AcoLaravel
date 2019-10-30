$(document).on("click",".checkHorarioJurado",function(){
    $(".loaderContainer").addClass('active');
    var idDocente = $(this).attr('id-docente');
    var idHorarioForo = $(this).attr('id-horario-foros');
    var hora = $(this).parent().find("small").text();
    var disponible = $(this).prop('checked') == true ? 1 : 0;
    var posicion  = $(this).attr('posicion');
    var token = $("[name='_token']").val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        url: "/addHour/setHorarioJurado",
        data: {'idDocente': idDocente, 'idHorarioForo': idHorarioForo, 'hora':hora, 'disponible': disponible, 'posicion': posicion},
        success: function(){
            console.log("bien");
            $(".loaderContainer").removeClass('active');
            $(".messageContainer").addClass('active');
            $(".messageContainer .message .icon").html('');
            $(".messageContainer .message .icon").append('<i class="fas fa-envelope"></i>');
            $(".messageContainer .message .title p").text('¡Registro Actualizado!');
            $(".messageContainer .message .description p").text('Su registro ha sido actualizado correctamente');
            setTimeout(() => {
                $(".messageContainer").removeClass('active');
            }, 1000);

        },
        error: function(){
            console.log("error");
            $(".loaderContainer").removeClass('active');
                $(".messageContainer").addClass('active');
                $(".messageContainer .message .icon").html('');
                $(".messageContainer .message .icon").append('<i class="fas fa-envelope"></i>');
                $(".messageContainer .message .title p").text('¡Error!');
                $(".messageContainer .message .description p").text('Ocurrió un error al intentar conectar al servidor. Inténtelo más tarde.');
                setTimeout(() => {
                    $(".messageContainer").removeClass('active');
                }, 3000);
        }
    });
})
