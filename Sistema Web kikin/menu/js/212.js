$(document).ready(main());
$('input[type="checkbox"]').change(function () {
  if ($(this).is(':checked')) {
    $('input[type="checkbox"]').not(this).prop('checked', false);
  }
});
var orden = "";

function main() {
}

$("input").keydown(function (e) {
  // Capturamos qué telca ha sido
  var keyCode = e.which;
  // Si la tecla es el Intro/Enter
  if (keyCode == 13) {
    // Evitamos que se ejecute eventos
    event.preventDefault();
    // Devolvemos falso
    return false;
  }
});

function imprimiendo(id) {
  $.ajax({
    type: 'POST',
    url: '../controlador/detallerecepcion.php',
    data: 'idOrden=' + id,
    success: function (r) {
      $("#tabla_detalle").html(r);
      document.getElementById("docrecepcion").value = id;
    }
  })
}


function imprimir() {
  var valor = "";
  valor = document.getElementById('docrecepcion').value;
  var n=0;
  for (var i = 0; i < 10000; i++) {
     n += i;
  for (var j = 0; j < 10000;j++) {
    n += i;
    for (var n = 0; n < 10000; n++) {
      n += i;
   }
 }
 }

  window.open("../reporte/212.php?valor=" + valor);
  presiondetalle();

}