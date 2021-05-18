<?php
include_once ("functions.php");
    
    if (isset($_POST["username"]) && isset($_POST["password"])){

        if (!empty($_POST["soyUnCeboBroder"])) exit;
        //obtenemos los datos del captcha automatico
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
        $recaptcha_secret = '6Lce_4EaAAAAALHYHP81uNqrfXRFIOkx_MaWsfGA'; 
        $recaptcha_response = $_POST['recaptcha_response']; 
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
        $recaptcha = json_decode($recaptcha); 
        if($recaptcha->score >= 0.7){ //si el captcha determina que obtienes una puntuacion cercana a 1 ergo eres un humano...
            if (login($_POST["username"],$_POST["password"], connectDB())){
                header("Location: main-menu.php");
            }
            else{
                header("Location: index.php?error=1");
            }
        }
        else{
            header("Location:index.php?invalidCaptcha=yes");
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="(max-width: 676px)" href="./css/celulares.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 676px) and (max-width: 1100px)"  href="./css/tablets.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 1100px)"  href="./css/ordenadores.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">    
    <link rel="shortcut icon" href="./pictures/GreenAppleLogo.ico" />
    <title>HappyApple!</title>
    <script src='https://www.google.com/recaptcha/api.js?render=6Lce_4EaAAAAAADlrj62E7V1gUXTY6wzrvniDtoL'> </script>
		<script>
			grecaptcha.ready(function() {
			grecaptcha.execute('6Lce_4EaAAAAAADlrj62E7V1gUXTY6wzrvniDtoL', {action: 'formulario'})
			.then(function(token) {
			var recaptchaResponse = document.getElementById('recaptchaResponse');
			recaptchaResponse.value = token;
			});});
		</script>
</head>
<body>


<div class="container" id="c1">

    <div class="login-box">       
        
        <div class="title-box">
            <h1 class="title">HappyApple</h1>
        </div>

        <div class="error-box">
            <b>
                <?php
                    if(isset($_GET["error"])){
                        showError($_GET["error"]);
                    }
                ?>
            </b>
        </div>

        <form action="index.php" method="POST">

            <div class="div-login-input" id="user-input">
                <input type="text" class="login-input" placeholder="Nombre de usuario" name="username" required/>
            </div>

            <div class="div-login-input" id="passwd-input">
                <input type="password" class="login-input" placeholder="Contraseña" name="password" required/>
            </div>

            <!-- Este input es un honey pot, una trampa de seguridad para evitar posibles ataques automatizados-->
            <div class="soyUnCeboBroder">
                <input type="text" name="soyUnCeboBroder" value=""/>
            </div>
            
            <div class="">
                <button class="btn" type="submit" id="login-btn">Iniciar sesión</button>
            </div>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        </form>

        <div class="remember-box">
            <a href="./remember.php">Recordar contraseña</a>
        </div>

    </div>

    <?php
    
        if((isset($_GET["logout"])) && $_GET["logout"] == "yes"){
            logout();
            ?>
            <div class="confirm-box">
                <b>Cierre de sesión exitoso.</b>
            </div>
            <?php

        }

        if((isset($_GET["registered"])) && $_GET["registered"] == "yes"){
            logout();
            ?>
            <div class="confirm-box">
                <b>Usuario registrado exitosamente.</b>
            </div>
            <?php
        }

        if((isset($_GET["saved"])) && $_GET["saved"] == "yes"){
            logout();
            ?>
            <div class="confirm-box">
                <b>Contraseña cambiada correctamente.</b>
            </div>
            <?php
        }
    
    ?>
    

    <div class="register-sug">

        <div class="register-box-text">
            ¿No tienes cuenta? <a href="register.php">Regístrate</a>
        </div>

    </div>

</div>

</body>
</html>