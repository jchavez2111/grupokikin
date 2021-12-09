$(document).ready(main());



var valor1 = "";
function main() {
    presionbutton();
    imprimir();
    guardarcomprobante();
}



function imprimiendo(id) {
    //console.log("checkbox presionado "+id);
    valor1 = id;
    imprimirtabla(valor1);
    imprimirprecio(valor1);
}

function imprimirprecio(id) {
    $.ajax({
        type: 'POST',
        url: '../controlador/imprimirprecio.php',
        data: 'idPedido=' + id,
        success: function (r) {
            $("#precio").html(r);
        }
    })
}

function imprimirtabla(id)
{
    $.ajax({
        type: 'POST',
        url: '../controlador/detalleped.php',
        data: 'idPedido=' + id,
        success: function (r) {
            $("#tabla_productos").html(r);
        }
    })
}

function guardarcomprobante(){
    
    if(valor1==null){
        alert("Selecciona un Pedido");
      }else{
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
        url: '../controlador/crearcomprobantepedido.php',
        data: { "pedido": valor1 }
      })
        .done(function (info) {
          console.log(info);
        })

    var modal_container = document.getElementById("modal_containerconfi");
    modal_container.classList.remove('show');
    window.open("../reporte/215.php?valor="+valor1);
    window.location.reload();
}


function imprimir() {
    if(valor1==null){
        alert("Selecciona un Pedido");
      }else{
        console.log("sifunciona");
    window.open("../reporte/215.php?valor="+valor1);
    }
}
