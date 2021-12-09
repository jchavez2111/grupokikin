$(document).ready(main());


var mesa="";

function main() {
  presionbutton();
  presionbuttondos();
  //presionbuttontres();
  presiondetalle();
  idmesa(id);
}


function quitar(id) {
  $('#tr' + id).remove();
}

function idmesa(id) {
  mesa=id;
  console.log(mesa);
}

//BotonSalirModel
function presionbutton() {
  $('#btnsalirmodel').click(function () {
    llenardatos();
  });
}

//BotonInventario
function presionbuttondos() {
  $('#btninventario').click(function () {
    limpiar();
  });
}

//BotonGenerar
function presionbuttontres(){
    var nuevoArray=validacion();
    if(cantidad()!=nuevoArray.producto.length){
      console.log("son diferentes");
    }
    else if(nuevoArray.producto.length==0){
      alert("Completa los campos");
    }
    else if(mesa==null){
      alert("Selecciona una mesa");
    }
    else{
      var modal_container= document.getElementById("modal_containerconfi");
      modal_container.classList.add('show');
    }
}

function cerrar(){
  var modal_container= document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
}

function cerraryguardar(){
  var json = JSON.stringify(validacion());
      $.ajax({
        type: 'POST',
        url: '../controlador/detallepedido.php',
        data: { "json": json, 'mesa': mesa }
      })
        .done(function (info) {
          console.log(info);
        })

  var modal_container= document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  location.href = "../paginas/202.php";
}

function presiondetalle() {
  var valor="";
  var texto="";
  $("#platos").change(function() {
    valor = $(this).val();
    texto = $(this).find('option:selected').text();
    $('#imprimirdetalleplato').click(function () {
      window.open("../reporte/209.php?plato="+valor+"&nombre="+texto+"");;
      presiondetalle();
  });
  });

}

//datos
function capturavalores() {
  var idproductos = [];
  $('#tabla_productos tr').each(function () {
    let check = $(this).find('#txtindices').is(':checked'); //true o false
    row = $(this).closest('tr');
    let id = row.find('td:eq(-5)').text()
    if (check) {
      idproductos.push(+id);
    }
  });
  $('#tabla_orden tr').each(function () {
    let check = $(this).find('#txtindices').is(':checked'); //true o false
    row = $(this).closest('tr');
    let id = row.find('td:eq(-6)').text()
    if (check) {
      idproductos.push(+id);
    }
  });
  return idproductos;
}

//llenartabla
function llenardatos() {
  var long = capturavalores().length;
  for (var i = 0; i < long; i++) {
    detallar(capturavalores()[i]);
  }
  console.log(capturavalores());
}

//llenardatos
function detallar(id) {
  $.ajax({
    type: 'POST',
    url: '../controlador/cargarplatosselec.php',
    data: 'id=' + id,
    success: function (r) {
      var d1 = document.getElementById('tabla_detalle');
      d1.insertAdjacentHTML('afterbegin',r);
    }
  })
}


//limpiardatos
function limpiar() {
  var long = capturavalores().length;
  for (var i = 0; i < long; i++) {
    quitar(capturavalores()[i]);
  }
}

//Validaciondecampos
function validacion() {
  var productos = [];
  $('#tabla_detalle tr').each(function(){
    let id=$(this).find('td').eq(0).text();
    let prod=$(this).find('td').eq(1).text();
    let precio=$(this).find('td').eq(2).text();
    let stock=$(this).find('td').eq(3).text();
    let cantidad=Math.round($(this).find('input[type="number"]').val());
    if(stock<cantidad){
      alert("El valor de "+prod+" supera el stock");
    }
    else if(cantidad==0){
      alert("Ingrese una cantidad para "+prod+"");
    }
    else if(cantidad<0){
      alert("Ingrese una cantidad válida para "+prod+"");
    }
    else{
        productos.push({
        id: +id,
        precio: +precio,
        cantidad: +cantidad
      });
    }
  });
  var lista = {"producto": productos};
  return lista;
}

function cantidad() {
  var cant=0;
  $('#tabla_detalle tr').each(function(){
    cant=cant+1;
  });
  return cant;
}