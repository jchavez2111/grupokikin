$(document).ready(main());

var idpedido="";
var idayudante="";

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
    idayudante=id;
    console.log(idayudante);
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
    else if(idayudante==null){
      alert("Selecciona un Mozo");
    }
    else{
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
    url: '../controlador/asignarpedidomozo.php',
    data: { "pedido": idpedido, 'mozo': idayudante }
  })
    .done(function (info) {
      console.log(info);
    })

  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  window.location.reload();
}
