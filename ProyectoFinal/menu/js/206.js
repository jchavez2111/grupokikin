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
  if (idreclamo == null) {
    alert("Selecciona un reclamo");
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
  $.ajax({
    type: 'POST',
    url: '../controlador/generarnota.php',
    data: { "reclamo": idreclamo}
  })
    .done(function (info) {
      console.log(info);
    })

  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');

  window.open("../reporte/206.php?valor="+idreclamo);
  //window.location.href = window.location.href;
}
