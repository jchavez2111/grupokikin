$(document).ready(main());

var idpedid = "";
var tiporeclamo= "";

function main() {
  presionbutton();
  ayudante(id);
}


function idpedido(id) {
  idpedid = id;
  console.log(idpedid);
  console.log(tiporeclamo);
}

function estado() {
  tiporeclamo = document.getElementById("platos").value;
  console.log(tiporeclamo);
}

//BotonSalirModel
function presionbutton() {
  $('#btnsalirmodel').click(function () {
    llenardatos();
  });
}

//BotonGenerar
function generarreclamo() {
  var coment = document.getElementById("comentario").value

  if (idpedid == null) {
    alert("Selecciona un pedido");
  }
  else if (coment == "") {
    alert("Escriba el detalle");
  }else if (tiporeclamo == null || tiporeclamo == 0){
    alert("Elija el tipo de reclamo");
  }
  else {
    var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.add('show');
    console.log(tiporeclamo&"juan");
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
    url: '../controlador/crearreclamo.php',
    data: { "pedido": idpedid, "comentario": coment, "tipo": tiporeclamo}
  })
    .done(function (info) {
      console.log(info);
    })

  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  //window.location.href = window.location.href;
}

