<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Recuperación de Contraseña</title>
        <link rel="shortcut icon" href="../img/ico.png">
       
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style2.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
       

        <script src="../js/password_strength.js"></script>
        <script src="../js/jquery-strength.js"></script>

    </head>
    <body>
        <div class="div__main_recovery">
            <div class="div__login">
                <div class="div__login-form">
                    <form method="POST" action="verificacion.php" class="form__login">

                        <?php
                        session_start();
                        $correito = $_SESSION["rcorreo"];
                        ?>
                        <h1 class="h1__form">Recupera tu contraseña</h1>
                        <h3>Ingresa tu código de recuperación que enviamos a tu correo:  <b><?php echo $correito ?></b></h3>
                        <div class="div__data">
                            <div class="div__content">
                                <label for="" class="label__login">Código de recuperación</label>
                                <input id="token" name="token" class="input__login2" placeholder="Ingresa tu código de recuperación">
                                <p class="warnings" id="alerta4"></p>
                            </div>
                            <!-- <div class="div__recuperacion">
                                <a href="" class="a__recuperacion">Volver a enviar</a>
                            </div> -->

                            <div class="div__content">
                                <label for="" class="label__login">Nueva Contraseña</label>
                                <input id="pass1" type="password" class="check-seguridad form-control input__login" placeholder="Ingresa tu nueva contraseña">
                            </div>
                            <br>
                            <div class="div__content">
                                <label for="" class="label__login">Confirma tu nueva Contraseña</label>
                                <input id="pass2" name="contraseña" type="password"class="check-seguridad form-control input__login" placeholder="Ingresa tu nueva contraseña">                                
                                <p class="warnings" id="alerta3"></p>                                
                            </div>
                            <br>

                            <div class="div__botones">
                                <button  id="verificacion" class="a__enviar">Actualizar</button>
                                <a href="recuperacion.html" class="a__google">Regresar</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Java Script -->
        <script src="../js/samepassword.js"></script>

        <script>
            jQuery(function ($) {

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