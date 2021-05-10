<?php
session_start();
function connectDB(){
    define("DB_HOST","localhost");
    define("DB_USER","admin"); 
    define("DB_PASS","admin");
    define("DB_DB","proyectofinal");

    $DB_LINK = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);
    return $DB_LINK;
}

function clear($value){
    $link = connectDB();
    return mysqli_real_escape_string($link, htmlspecialchars($value));

}

function register($DB_LINK, $email, $password, $nombre, $apellidos, $telefono){
    $name = clear($_POST["name"]); 
    $user = clear($_POST["username"]); 
    $email = clear($_POST["email"]);
    $password = generateHash(clear($_POST["password"]));
    if(!$DB_LINK = connectDB()) return false;
    $query = "INSERT INTO usuarios (Usuario, Nombre completo, Correo, Contraseña) VALUES ('$user','$name', '$email', '$password')";
    $res = mysqli_query($DB_LINK, $query);
    if ($res) {
        return true;
    }
    else{
        return false;
    }
    
}

function login ($username, $password, $DB_LINK){ //verificacion de user y password en login
    $username = clear($username);
    $password = clear($password);
    $query = "SELECT * FROM usuarios where Usuario = '$username'";

    if($res = mysqli_query($DB_LINK, $query)){
        if (mysqli_num_rows($res) == 1 ) {
            $rows = mysqli_fetch_array($res); //obtenemos todos los campos de ese usuario 
            if (passwordCheck($DB_LINK, $username, $password, $rows["Contraseña"])){
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT']; //metodos adicionales para evitar robo de sesiones
                $_SESSION['IPaddress'] = getClientIp();
                $_SESSION["username"] = $username;
                $_SESSION["id"] = $rows["id"]; //guardaremos la id para evitar que luego pueda editar a otros usuarios si introduce la url
                session_regenerate_id(true); //cambiamos el id de la sesion para evitar posibles fijados de sesion
                return true;
            }
            else{
                return false;
            }
        }  
        else {
            return false;
        }
    }
}

function isLoggedIn(){ //verifica que esté logueado el user y que posea la ip y user agent del navegador instanciados al realizar el login correcto para evitar robo de sesiones
    $inactividad = 120; //en segundos
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("location:index.php?sessionClosed=inactivity");  //cerramos sesion por inactividad
        }
    }
    if (isset($_SESSION['userAgent']) && isset($_SESSION['IPaddress'])){
        if (($_SESSION['userAgent'] == $_SERVER['HTTP_USER_AGENT']) && ($_SESSION['IPaddress'] == getClientIp())){
            $_SESSION["timeout"] = time(); // la siguiente key se crea cuando se inicia sesion
            return isset($_SESSION["username"]);
        }
    }
}

function generateHash($password){ //hasheamos la contrasena
    $hash = password_hash($password, PASSWORD_DEFAULT); //funcion de php que usa el ultimo algoritmo conocido seguro
    return $hash;
}

function passwordCheck($DB_LINK, $username, $password, $hash){ //comprobamos que la contrasena introducida es la misma que la misma almacenada en la BBDD

    if (password_needs_rehash($hash, PASSWORD_DEFAULT)){ //si necesita aplicarse otro algoritmo más seguro se le aplicará automáticamente
        $newHash = generateHash($password);
        $query2 = "UPDATE usuarios SET Contraseña = '$newHash' WHERE Usuario = '$username'";
        mysqli_query($DB_LINK, $query2);
    }
    if(password_verify($password, $hash)){ //comprobamos que sea la misma contraseña
        
        return true; //habremos accedido
    }
    else{
        return false;
    }
}

function getClientIp() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function logout(){ //cierre de sesion
    unset($_SESSION);
    session_destroy();
    session_start();
    session_regenerate_id(true);
}

function repeated($mail, $user, $DB_LINK){
    $consulta = "SELECT * FROM usuarios WHERE Correo='$mail'";
    $consulta2 = "SELECT * FROM usuarios WHERE Usuario='$user'";
    $resultado=mysqli_query($DB_LINK, $consulta);
    $resultado2=mysqli_query($DB_LINK, $consulta2);
    if(mysqli_num_rows($resultado) || mysqli_num_rows($resultado2)){
        return true;
    }
    
}

function checks($nombre, $email, $usuario, $contraseña){ //checks de tipos y longitudes de datos introducidos
    $response = 100; //cuando devuelva 100 está todo ok
    $allowed = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ- "; //caracteres permitidos para nombre y apellido
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); //elimina caracteres ilegales
    $flag = false;
    for ($i=0; $i<strlen($nombre); $i++){ //comprobamos que el nombre esté entre los caracteres permitidos
        if (strpos($allowed, substr($nombre, $i, 1))===false){
            $flag = true;
        }
    }
    if ($flag)
        return 0;
    if (strlen($nombre)>25) // longitud nombre y apellido correctas
        return 1;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //si no es un email valido falla
        return 4;
    
    return $response;
}
?>