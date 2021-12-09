$(document).ready(main());

var idreclamo= "";

function reclamo(id){
    idreclamo=id;
    $.ajax({
        type: 'POST',
        url: '../controlador/imprimirdetreclamo.php',
        data: 'id=' + id,
        success: function (r) {
            $("#detalle").html(r);
        }
      })
}
  

//BotonGenerar
function generarnota() {
  var fecha= document.getElementById("vencimiento").value;
  console.log(fecha);
  if (idreclamo == null) {
    alert("Selecciona un reclamo");
  }else if (fecha == "") {
    alert("Selecciona una fecha de vencimiento");
  }
  else {
    var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.add('show');
  }
}

function cerrar() {
  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
}

function cerraryguardar() {
  var fecha= document.getElementById("vencimiento").value;
  $.ajax({
    type: 'POST',
    url: '../controlador/generarnota.php',
    data: { "reclamo": idreclamo, "fecha": fecha}
  })
    .done(function (info) {
      console.log(info);
      window.open("../reporte/206.php?valor="+idreclamo);
    })

  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  //window.location.href = window.location.href;
}
