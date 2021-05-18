<?php

include_once ("functions.php");


if ($DB_LINK=connectDB()){
    if (isset($_POST["email"])){
        $email=clear($_POST["email"]);

        if(resetPassword()){
            header("location: index.php?changed=yes");
        }
        else{
            header("location: index.php?error=9"); //CARLOS
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
    <link rel="shortcut icon" href="./pictures/GreenAppleLogo.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">    
    <title>HappyApple!</title>
</head>
<body>

<div class="container">

    <div class="remember-box-2">
        
        <form action="" method="">
            
            <label>Escriba su correo electrónico</label>
            <input type="text" name="email" required/>
            <button class="btn" type="submit" id="remember-btn">Enviar</button>

        </form>

    </div>
    
    <div class="register-sug">

        <div class="register-box-text">
            ¿Recordaste la contraseña? <a href="index.php">Inicia sesión</a>
        </div>

    </div>

</div>
   

<?php 
}
?>


</body>
</html>