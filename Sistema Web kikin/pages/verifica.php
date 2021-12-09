<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">      
        <link rel="shortcut icon" href="../img/ico.png">
        <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/estilos.css">

        <title>Recuperación de Contraseña</title>


        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

        <link rel="stylesheet" href="css/strength.css">
        <script src="../js/password_strength.js"></script>
        <script src="../js/jquery-strength.js"></script>

    </head>
    <body>
        <div class="div__main_recovery">
            <div class="div__login">
                <div class="div__login-form">
                    <form method="POST" action="verificacion.php" class="form__login" id="formulario">

                        <?php
                        session_start();
                        $correito = $_SESSION["rcorreo"];
                        ?>
                        <h1 class="h1__form">Recupera tu contraseña</h1>
                        <h3>Ingresa tu código de recuperación que enviamos a tu correo tu correo:  <b><?php echo $correito ?></b></h3>
                        <div class="div__data">
                            <div class="div__content">
                                <label for="" class="label__login">Código de recuperación</label>
                                <input id="token" name="token" class="input__login" placeholder="Ingresa tu código de recuperación">
                                <p class="warnings" id="alerta4"></p>
                            </div>
                            <!-- <div class="div__recuperacion">
                                <a href="" class="a__recuperacion">Volver a enviar</a>
                            </div> -->

                            <!-- Grupo: Contraseña -->
                            <div class="formulario__grupo" id="grupo__password">
                                <label for="password" class="formulario__label">Nueva Contraseña</label>
                                <div class="formulario__grupo-input">
                                    <input type="password" class="formulario__input check-seguridad form-control input__login" name="password" id="password" id="pass1" placeholder="Ingresa tu nueva contraseña">
                                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                </div>
                                <p class="formulario__input-error">La contraseña tiene que ser de 6 a 12 dígitos.</p>
                            </div>

                            <!-- Grupo: Contraseña 2 -->
                            <div class="formulario__grupo" id="grupo__password2">
                                <label for="password2" class="formulario__label">Confirma tu nueva Contraseña</label>
                                <div class="formulario__grupo-input">
                                    <input type="password" class="formulario__input check-seguridad form-control input__login" name="password2" id="password2" id="pass2"  placeholder="Ingresa tu nueva contraseña">
                                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                </div>
                                <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                            </div>                


                            <div class="formulario__mensaje" id="formulario__mensaje">
                                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
                            </div>




                            <div class="div__botones">
                                <button  id="verificacion" class="a__enviar" >Acceder</button>
                                <a href="recuperacion.html" class="a__google">Regresar</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Java Script -->
        <script src="../js/formulario.js"></script>
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        
        <script>
		jQuery(function($) {
			
			$(".check-seguridad").strength({
				templates: {
    			toggle: '<span class="input-group-addon"><span class="glyphicon glyphicon-eye-open {toggleClass}"></span></span>'
                
                },
                scoreLables: {
                        empty: 'Vacío',
                        invalid: 'Invalido',
                        weak: 'Débil',
                        good: 'Bueno',
                        strong: 'Fuerte'
                    }, 
                scoreClasses: {
                        empty: '',
                        invalid: 'label-danger',
                        weak: 'label-warning',
                        good: 'label-info',
                        strong: 'label-success'
                    },

			});
		});
	</script>
        
    </body>
</html>