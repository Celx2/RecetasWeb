<?php

include_once ("functions.php");


if ($DB_LINK=connectDB()){
    if (isset($_POST["email"])){
        $email=clear($_POST["email"]);

        if(ResetPassword()){
            header("location: index.php?changed=yes");
        }
        else{
            header("location: index.php?error=2424"); //CARLOS
        }
    }




//aquí va el html con un un campo para meter el correo electrónico que se autoenvie a sí mismo
} //deja este cierre abajo del todo, debajo del html
?>