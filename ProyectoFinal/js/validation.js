/*==================== INDEX ====================*/
const nombre=document.getElementById("usuario")
const contraseña=document.getElementById("contraseña")
const alerta1=document.getElementById("alerta1")
const alerta2=document.getElementById("alerta2")
const boton1=document.querySelector("#enviar")

boton1.addEventListener("click", e=>{
    
    let alert1=""
    let alert2=""
    let entrar=false
    alerta1.innerHTML=""
    alerta2.innerHTML=""
    if(nombre.value.length<1){
        e.preventDefault()
        alert1 +='Ingresa el usuario.'
        entrar=true
        if(entrar){
            alerta1.innerHTML=alert1
        }
    }
    if(contraseña.value.length<1){
        e.preventDefault()
        alert2 +='Ingresa la contraseña.'
        entrar=true
        if(entrar){
            alerta2.innerHTML=alert2
        }
    }
    else{

    }
});
