$(document).ready(main());
$('input[type="checkbox"]').change(function(){
  if($(this).is(':checked')){
      $('input[type="checkbox"]').not(this).prop('checked', false);
  }
});
var orden="";

function main() {
    imprimir();
}

$("input").keydown(function (e){
    // Capturamos qué telca ha sido
    var keyCode= e.which;
    // Si la tecla es el Intro/Enter
    if (keyCode == 13){
      // Evitamos que se ejecute eventos
      event.preventDefault();
      // Devolvemos falso
      return false;
    }
});

function imprimiendo(id){
    $.ajax({
      type: 'POST',
      url: '../controlador/detallerecepcion.php',
      data: 'idOrden='+id,
      success:function(r){
        $("#tabla_detalle").html(r);
        document.getElementById("docrecepcion").value = id;
      }
    })
  }




  function imprimir() {
    var valor="";
    valor=document.getElementById('valor').value;
    $('#imprimirrecepcion').click(function () {
        window.open("../reporte/211.php?valor="+valor);
        presiondetalle();
    });
  }