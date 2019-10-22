function capturar() {
    limpiar();
    var cantidad = document.getElementById("cantidadToken").value;
    var botonGuardar = document.getElementById("guardar");
    var div = document.getElementById("main");
    if (cantidad > 0 && cantidad != "") {
      botonGuardar.style.display = "block";
    }
    for (var i = 1; i <= cantidad; i++) {
      var contenedor = document.createElement("div");
      contenedor.setAttribute("class", "form-group");
      contenedor.innerHTML = "<label for='matricula'> Matricula #" + i + "</label>" +
        "<input class='form-control' type='text' name='nocontrol[]'  class='form-control' placeholder='Número de control'>";
      div.appendChild(contenedor);
    }
  }

  function limpiar() {
    var div = document.getElementById("main");
    var botonGuardar = document.getElementById("guardar");
    botonGuardar.style.display = "none";
    // var cantidad = document.getElementById("cantidadToken").value = "";
    if (div !== null) {
      cantidad = "";
      while (div.hasChildNodes()) {
        div.removeChild(div.lastChild);
      }
    }
  }

  $(document).ready(function() {
    var duration = 4000; // 4 seconds
    setTimeout(function () { $('#alert-fade').hide("fade"); }, duration);
  });