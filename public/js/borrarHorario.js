$(document).on("click",".modal .borrar",function(){
    $(".loaderContainer").addClass('active');
    var element = $(this).parent().parent();
    var idHorario = element.find("input[name='idHorario1']").val();
    var token = $("[name='_token']").val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        url: "/foros/borrarHorario",
        data: { 'idHorario' : idHorario},
        success: function(){
            console.log("bien");
            $(".loaderContainer").removeClass('active');
            $(".messageContainer").addClass('active');
            $(".messageContainer .message .icon").html('');
            $(".messageContainer .message .icon").append('<i class="fas fa-envelope"></i>');
            $(".messageContainer .message .title p").text('¡Registro Borrado!');
            $(".messageContainer .message .description p").text('Su registro ha sido borrado exitosamente');

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
