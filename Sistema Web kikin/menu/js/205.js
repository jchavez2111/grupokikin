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
    guardarcomprobante();
}

function listarorden(){
    var boton = document.getElementById("button1");
    boton.onclick = function (e){
      e.preventDefault();
      fechamin = document.getElementById("fecha1").value;
      fechamax = document.getElementById("fecha2").value;
      $.ajax({
        type: 'POST',
        url: '../controlador/cargarordenpago.php',
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
      url: '../controlador/detallecomprobante.php',
      data: 'idOrden='+id,
      success:function(r){
        $("#tabla_productos").html(r);
      }
    })
  }


  var valor="";


  function guardarcomprobante(){
    var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.add('show');
  }

  function cerrar() {
    var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.remove('show');
  }
  
  function cerraryguardar() {
    $('#tabla_orden tr').each(function () {
      let check = $(this).find('#txtindices').is(':checked'); //true o false
      row = $(this).closest('tr');
      let id = row.find('td:eq(-5)').text()
      if (check) {
        console.log(id);
        var ret =id.replace('OPR','');
        console.log(ret);
        $.ajax({
          type: 'POST',
          url: '../controlador/crearcomprobante.php',
          data: 'id='+ret,
          success:function(r){
            valor=+r;
            console.log(r);
            console.log(valor);
            window.open("../reporte/205.php?valor="+valor);
          }
        })
          .fail(function () {
            console.log('Hubo un errror en el filtro')
       })
      }
      
    });
    var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.remove('show');
    //location.reload();
  }

