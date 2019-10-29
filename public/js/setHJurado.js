$(document).on("click",".checkHorarioJurado",function(){
    var idDocente = $(this).attr('id-docente');
    var idHorarioForo = $(this).attr('id-horario-foros');
    var hora = $(this).parent().find("small").text();
    var disponible = 1;
    var posicion  = 0;
    var token = $("[name='_token']").val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        url: "/addHour/setHorarioJurado",
        data: {'idDocente': idDocente, 'idHorarioForo': idHorarioForo, 'hora':hora, 'disponible': disponible, 'posicion': posicion},
        success: function(){
            console.log("bien");
            $(".loaderContainer").removeClass('active');
        },
        error: function(){
            console.log("error");
            $(".loaderContainer").removeClass('active');
        }
    });
})
