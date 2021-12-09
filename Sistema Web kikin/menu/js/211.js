$(document).ready(main());

var orden = "";
var seleccion = "1";
var contadorfe;

function main() {
  listarorden();
  presionbutton();
  imprimir();
}

function listarorden() {
  var boton = document.getElementById("button1");
  boton.onclick = function (e) {
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

function imprimiendo(id) {
  seleccion = "2";
  console.log(seleccion);
  //console.log("checkbox presionado "+id);
  $.ajax({
    type: 'POST',
    url: '../controlador/detalleordprodreq.php',
    data: 'idOrden=' + id,
    success: function (r) {
      $("#tabla_productos").html(r);
      $("#numeroorden").html("Detalle de productos requeridos OPR" + id);
      orden = +id;
    }
  })
}


function capturavalores() {
  var productos = [];
  $('#tabla_productos tr').each(function () {
    let check = $(this).find('#txtindices').is(':checked'); //true o false
    row = $(this).closest('tr');
    let cantidad = row.find('td:eq(-2)').text();
    let id = row.find('td:eq(-6)').text();
    let fecha = $(this).find('#fechav').val(); 
    console.log(fecha);
    if (check) {
      console.log(fecha);
      if (fecha == "") {
        console.log("Selecciona una fecha de vencimiento");
      }else{
        productos.push({
          id: +id,
          cantidad: +cantidad,
          fecha: fecha
        });
      }
    }
  });
  var lista = { "producto": productos };
  return lista;
}

function actualizar() {
  
  var nuevoArray = capturavalores	();
  if (nuevoArray.producto.length==0) {
    alert("Selecciona y ingrese los valores en los productos.");
  } else if(cantidad() != nuevoArray.producto.length){
    alert("Selecciona una fecha de vencimiento");
  } 
  else if(cantidad() == nuevoArray.producto.length){
  console.log("Son iguliatisoo");
   var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.add('show');
  }
  else {
  console.log("Error");
    
  }
}

function cantidad() {
  var cant = 0;
  $('#tabla_productos tr').each(function () {
    let check = $(this).find('#txtindices').is(':checked');
    if (check) {
    cant = cant + 1;
    }
  });
  return cant;
}

function imprimir(id) {
  window.open("../reporte/211.php?valor=" + id);
}

function cerrar() {
  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
}

function cerraryguardar() {
  console.log(orden);
  var json = JSON.stringify(capturavalores());
  $.ajax({
    type: 'POST',
    url: '../controlador/insertarrecepcion.php',
    data: { "json": json, 'orden': orden }
  })
    .done(function (info) {
      console.log(info);
    })
  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  location.reload();
}