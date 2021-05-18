<?php

include_once ("functions.php");

if ($DB_LINK=connectDB()){
    if ($_POST["password"] == $_POST["password2"]){ //Miramos que las dos son iguales
        $token = clear($_GET["token"]); //Cogemos el token
        $comprobacion="SELECT * FROM usuarios WHERE token='$token'";
        $resulcomprobacion=mysqli_query($ENLACE_DB, $comprobacion);

        if (mysqli_num_rows($resulcomprobacion)==1){
        $password=generateHash(clear($_POST["password"])); //Guardamos la contraseña
        $consulta="UPDATE usuarios SET token='0', contrasena='$password' WHERE token='$token'";
        if ($resultado=mysqli_query($DB_LINK, $consulta)){
            header("Location: index.php?saved=yes");
            exit;
        }
        
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

            <label>¡Ya estás más cerca!</label>
            <input type="password" placeholder="Nueva contraseña" name="password" required/>    
            <button class="btn" type="submit" id="remember-btn">Enviar</button>

        </form>

    </div>

</div>


<?php 
}
?>
</body>
</html>

