const contraseña2=document.getElementById("pass1")
const contraseña3=document.getElementById("pass2")
const alerta3=document.getElementById("alerta3")
const boton2=document.querySelector("#verificacion")

boton2.addEventListener("click", a=>{
    let alert3=""
    let entrar=false
    alerta3.innerHTML=""

    if(contraseña2.value!=contraseña3.value){
        a.preventDefault()
        alert3 +='Las contraseñas no coinciden.'
        entrar=true
        if(entrar){
            alerta3.innerHTML=alert3
        }
    }
    if(contraseña2.value == '' && contraseña3.value == ''){
        a.preventDefault()
        alert3 +='Ingresa las contraseñas.'
        entrar=true
        if(entrar){
            alerta3.innerHTML=alert3
        }
    }
    else{
        
    }

});