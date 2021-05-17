<?php

include_once ("functions.php");

if (isset($_POST["name"]) && isset ($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"])){//que todos estén puestos7

    //se limpia de posible inyeccion de codigo
    $name = clear($_POST["name"]);
    $email = clear($_POST["email"]);
    $username = clear($_POST["username"]);
    $password = generateHash(clear($_POST["password"]));

    //se comprueba que no existe otro mail igual en la base de datos y el resto de checks
    if (!$DB_LINK=connectDB()) return false;
    repeated($email, $username, $DB_LINK);
    checks($name, $email, $username, $password);
    
    $query="INSERT INTO usuarios (Usuario, Nombre_completo, Correo, Contraseña) VALUES ('$username', '$name', '$email','$password')";
    $res = mysqli_query($DB_LINK, $query);
    if($res){
        header("location:index.php?registered=yes");
    }
    else{
        header("location:register.php?error=3");
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
    <title>HappyApple!</title>
</head>
<body>

<div class="container" id="c1">

    <div class="register-box">       
        
        <div class="title-box">
            <h1 class="title">HappyApple!</h1>
        </div>


        <?php
        if(isset($_GET["error"])){
            showError($_GET["error"]);
        }
        else{
        ?>
        <div class="text-box">
            <h2 class="text">¡Empieza ahora a descubrir miles de recetas!</h2>
        </div>
        <?php
        }
        ?>

        <form action="register.php" method="POST">

            <div class="div-login-input">
                <input type="text" class="login-input" placeholder="Nombre completo" name="name" required="required" pattern="[a-zA-Z ]+" minlength="10" maxlength="40"/>
            </div>

            <div class="div-login-input">
                <input type="text" class="login-input" placeholder="Correo electrónico" name="email" required="required" pattern="^[^ ]+@[^ ]+\.[a-z]{2,6}$"/>
            </div>

            <div class="div-login-input">
                <input type="text" class="login-input" placeholder="Nombre de usuario" name="username" required="required" minlength="5" maxlength="20"/>
            </div>

            <div class="div-login-input">
                <input type="password" class="login-input" placeholder="Contraseña" name="password" required="required" minlength="6" maxlength="30"/>
            </div>

            <div class="">
                <button class="btn" type="submit" id="login-btn">Registrarme</button>
            </div>
        </form>

        <div class="politics-text">
            <p>
                Al registrarte, aceptas nuestras Condiciones. Obtén más información sobre cómo recopilamos, 
                usamos y compartimos tu información en la Política de datos, así como el uso que hacemos de
                 las cookies y tecnologías similares en nuestra Política de cookies.
            </p>
        </div>        

    </div>

    <div class="register-sug">

        <div class="register-box-text">
            ¿Tienes cuenta? <a href="index.php">Inicia sesión</a>
        </div>

    </div>

</div>

</body>
</html>