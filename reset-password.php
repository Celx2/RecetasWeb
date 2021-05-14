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

}//deja este cierre debajo del todo, debajo del html
?>

