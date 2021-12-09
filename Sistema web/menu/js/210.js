$(document).ready(main());

function main() {
  presionbutton();
  presionbuttondos();
  presionbuttontres();
  imprimir();
  descargar();
}


function quitar(id) {
  $('#tr' + id).remove();
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
function presionbuttontres() {
  $('#guardartodo').click(function () {
    var nuevoArray=validacion();
    if(cantidad()!=nuevoArray.producto.length){
      console.log("son diferentes");
    }else{
      console.log("son iguales");
      var json = JSON.stringify(validacion());
      $.ajax({
        type: 'POST',
        url: '../controlador/ordenproductosrequeridos.php',
        data: { "json": json }
      })
        .done(function (info) {
          console.log(info);
        })
      }
    //window.location.replace("../paginas/210.php");
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
    url: '../controlador/cargarelemento.php',
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
    let stock=$(this).find('td').eq(3).text();
    let cantidad=Math.round($(this).find('input[type="number"]').val());
    if(cantidad>99){
      alert("Debe reducir la cantidad de "+prod);
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

function imprimir() {
  var valor="";
  valor=document.getElementById('valor').value;
  $('#imprimirorden').click(function () {
      window.open("../reporte/210.php?valor="+valor);
      presiondetalle();
  });
}