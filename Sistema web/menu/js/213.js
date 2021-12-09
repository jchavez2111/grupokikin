$(document).ready(main());

var idpedido = "";
var estadop ="";

function main() {
  presionbutton();
  ayudante(id);
}


function ayudante(id) {
  idpedido = id;
  console.log(idpedido);
}

function estado() {
  i/* Para obtener el valor */
  estadop = document.getElementById("estado").value;
  console.log(estadop);
}

//BotonSalirModel
function presionbutton() {
  $('#btnsalirmodel').click(function () {
    llenardatos();
  });
}

//BotonGenerar
function presionbuttontres() {

  var coment = document.getElementById("comentario").value

  if (idpedido == null) {
    alert("Selecciona un pedido");
  }
  else if (coment == "") {
    alert("Escriba un comentario");
  }else if (estado == ""){
    alert("Falta completar");
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
  var coment = document.getElementById("comentario").value
  console.log(coment);
  $.ajax({
    type: 'POST',
    url: '../controlador/finalizarpedido.php',
    data: { "pedido": idpedido, "comentario": coment, "estado": estadop}
  })
    .done(function (info) {
      console.log(info);
    })

  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  window.location.reload();
}

