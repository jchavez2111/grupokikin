$(document).ready(main());

var idreclamo= "";
var estadoaprob= "";

function aprobar() {
    estadoaprob=1;
  }

  function desaprobar(){
    estadoaprob=2;
  }
  
  function reclamo(id){
    idreclamo=id;

    $.ajax({
        type: 'POST',
        url: '../controlador/cargardetallereclamo.php',
        data: 'id=' + id,
        success: function (r) {
          //var d1 = document.getElementById('tabla_detalle');
          //d1.insertAdjacentHTML('afterbegin',r);
          document.getElementById("coment").innerHTML = r;
        }
      })
  }
  

//BotonGenerar
function evaluarreclamo() {
  var coment = document.getElementById("comentario").value
  if (idreclamo == null) {
    alert("Selecciona un reclamo");
  }
  else if (coment == "") {
    alert("Escriba el detalle");
  }
  else if (estadoaprob==null){
    alert("Evalúe el reclamo");
  }
  else {
    var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.add('show');
    console.log("reclamo "+idreclamo+" estado "+estadoaprob + coment);
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
    url: '../controlador/evaluarreclamo.php',
    data: { "reclamo": idreclamo, "comentario": coment, "estado": estadoaprob}
  })
    .done(function (info) {
      console.log(info);
    })

  var modal_container = document.getElementById("modal_containerconfi");
  modal_container.classList.remove('show');
  //window.location.href = window.location.href;
}
