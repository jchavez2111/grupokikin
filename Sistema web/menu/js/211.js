$(document).ready(main());
$('input[type="checkbox"]').change(function(){
  if($(this).is(':checked')){
      $('input[type="checkbox"]').not(this).prop('checked', false);
  }
});


var orden="";

function main() {
    listarorden();
    presionbutton();
    imprimir();
}

function listarorden(){
    var boton = document.getElementById("button1");
    boton.onclick = function (e){
      e.preventDefault();
      fechamin = document.getElementById("fecha1").value;
      fechamax = document.getElementById("fecha2").value;
      $.ajax({
        type: 'POST',
        url: '../controlador/cargarorden.php',
        data: { 'id1': fechamin, 'id2': fechamax }
      })
        .done(function (listas_rep) {
          $("#fila").remove();
          $('#tabla_orden').html(listas_rep)
        })
        .fail(function () {
          alert('Hubo un errror en el filtro')
        })
    }
  }

function imprimiendo(id){
  //console.log("checkbox presionado "+id);
    $.ajax({
      type: 'POST',
      url: '../controlador/detalleordprodreq.php',
      data: 'idOrden='+id,
      success:function(r){
        $("#tabla_productos").html(r);
        $("#numeroorden").html(id);
        orden=+id;
      }
    })
  }

  function presionbutton() {
    $('#btnguardartodo').click(function () {
      actualizar();
      //window.location.replace("../paginas/211.php");
    });
  }

  function capturavalores() {
    var productos = [];
    $('#tabla_productos tr').each(function () {
      let check = $(this).find('#txtindices').is(':checked'); //true o false
      row = $(this).closest('tr');
      let cantidad =row.find('td:eq(-2)').text()
      let id = row.find('td:eq(-5)').text()
      if (check) {
        productos.push({
          id: +id,
          cantidad: +cantidad
        });
      }
    });
    var lista = {"producto": productos};
    return lista;
  }

  function actualizar() {
    console.log(orden);
    var json = JSON.stringify(capturavalores());
    $.ajax({
      type: 'POST',
      url: '../controlador/insertarrecepcion.php',
      data: { "json": json, 'orden': orden}
    })
      .done(function (info) {
        console.log(info);
      })
  
  }
  function cantidad() {
    var cant=0;
    $('#tabla_productos tr').each(function(){
      cant=cant+1;
    });
    return cant;
  }

  function imprimir() {
    var valor="";
    valor=document.getElementById('valor').value;
    $('#imprimirrecepcion').click(function () {
        window.open("../reporte/211.php?valor="+valor);
        presiondetalle();
    });
  }