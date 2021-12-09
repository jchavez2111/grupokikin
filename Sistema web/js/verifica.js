const contraseña4=document.getElementById("pass4")
const contraseña5=document.getElementById("pass5")
const token=document.getElementById("token")
const alerta4=document.getElementById("alerta4")
const alerta5=document.getElementById("alerta5")
const boton5=document.querySelector("#verifica")

boton5.addEventListener("click", a=>{
    let alert4=""
    let entrar=false
    alerta4.innerHTML=""
    let alert5=""
    let entrar=false
    alerta5.innerHTML=""

    if(contraseña4.value!=contraseña5.value){
        a.preventDefault()
        alert4 +='Las contraseñas no coinciden.'
        entrar=true
        if(entrar){
            alerta4.innerHTML=alert4
        }
    }
    else if(token.value == ''){
         a.preventDefault()
         alert5 +='Ingresa el código de seguridad.'
        entrar=true
         if(entrar){
             alerta5.innerHTML=alert5
         }
    }
    else if(contraseña4.value == '' && contraseña5.value == ''){
        a.preventDefault()
        alert4 +='Ingresa las contraseñas.'
        entrar=true
        if(entrar){
            alerta4.innerHTML=alert4
        }
        if(token.value == ''){
            alert5 +='Ingresa el código de seguridad.'
            entrar=true
            if(entrar){
                alerta5.innerHTML=alert5
            }
        }
    }
    else{
        
    }

});