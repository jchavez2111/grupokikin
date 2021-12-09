/*==================== Recuperacion ====================*/
const nombrer=document.getElementById("usuarior")
const alerta1r=document.getElementById("alerta1r")
const boton1r=document.querySelector("#enviarr")

boton1r.addEventListener("click", e=>{ 
    let alert1r=""
    let entrarr=false
    alerta1r.innerHTML=""
    if(nombrer.value.length<1){
        e.preventDefault()
        alert1r +='Ingresa el usuario.'
        entrarr=true
        if(entrarr){
            alerta1r.innerHTML=alert1r
        }
    }
    else{

    }
});