$(document).ready(main());

var idpedido="";
var idrepartidor="";

function main() {
  presionbutton();
  pedido(id);
  ayudante(id);
}



function pedido(id) {
  idpedido=id;
  console.log(idpedido);

  $.ajax({
    type: 'POST',
    url: '../controlador/cargardetallepedido.php',
    data: 'id=' + id,
    success: function (r) {
      $("#tabla_detalle").html(r);
    }
  })
}

function ayudante(id) {
    idrepartidor=id;
    console.log(idrepartidor);
  }

//BotonSalirModel
function presionbutton() {
  $('#btnsalirmodel').click(function () {
    llenardatos();
  });
}

//BotonGenerar
function presionbuttontres(){

    if(idpedido==null){
      alert("Selecciona un Pedido");
    }
    else if(idrepartidor==null){
      alert("Selecciona un repartidor");
    }
    else{
      var modal_container = document.getElementById("modal_containerconfi");
        modal_container.classList.add('show')
    }
}


function cerrar() {
  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
}

function cerraryguardar() {
  $.ajax({
    type: 'POST',
    url: '../controlador/asignarpedidorepartidor.php',
    data: { "pedido": idpedido, 'repartidor': idrepartidor }
  })
    .done(function (info) {
      console.log(info);
    })
  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  window.location.reload();
}