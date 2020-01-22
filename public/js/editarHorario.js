$(document).on("click",".modal .cambiar",function(){
    $(".loaderContainer").addClass('active');
    var element = $(this).parent().parent();
    var fecha = element.find("input[name='fecha']").val();
    var inicio = element.find("input[name='h_inicio']").val();
    var termino = element.find("input[name='h_termino']").val();
    var idHorario = element.find("input[name='idHorario']").val();
    var token = $("[name='_token']").val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        url: "/foros/editarHorario",
        data: { 'fecha': fecha, 'inicio':inicio, 'termino': termino, 'idHorario' : idHorario},
        success: function(){
            console.log("bien");
            $(".loaderContainer").removeClass('active');
            $(".messageContainer").addClass('active');
            $(".messageContainer .message .icon").html('');
            $(".messageContainer .message .icon").append('<i class="fas fa-envelope"></i>');
            $(".messageContainer .message .title p").text('¡Registro Actualizado!');
            $(".messageContainer .message .description p").text('Su registro ha sido actualizado correctamente');
            location.reload();
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
});
