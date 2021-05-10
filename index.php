<?php
include_once ("functions.php");
    
    if (isset($_POST["username"]) && isset($_POST["password"])){

        if (!empty($_POST["soyUnCeboBroder"])) exit;
        if (login($_POST["username"],$_POST["password"], connectDB())){
            header("Location: main-menu.php");
        }
        else{
            header("Location: index.php?error=1");
        }
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="(max-width: 576px)"  href="./css/celulares.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 576px)"  href="./css/ordenadores.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">    
    <title>Login</title>
</head>
<body>


<div class="container" id="c1">

    <div class="login-box">       
        
        <div class="title-box">
            <h1 class="title">El Título</h1>
        </div>

        <?php
            if(isset($_GET["error"])){
                showError($_GET["error"]);
            }
        ?>

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
        </form>

        <div class="remember-box">
            <a href="">Recordar contraseña</a>
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
    
    ?>
    

    <div class="register-sug">

        <div class="register-box-text">
            ¿No tienes cuenta? <a href="register.php">Regístrate</a>
        </div>

    </div>

</div>

</body>
</html>