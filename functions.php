<?php
session_start();
define("DB_HOST","localhost");
define("DB_USER","admin"); 
define("DB_PASS","admin");
define("DB_DB","proyectofinal");

function connectDB(){
    $DB_LINK = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);
    return $DB_LINK;
}

function clear ($value){
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
    if (isset($_SESSION['userAgent']) && isset($_SESSION['IPaddress'])){
        if (($_SESSION['userAgent'] == $_SERVER['HTTP_USER_AGENT']) && ($_SESSION['IPaddress'] == getClientIp())){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
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

function generateToken(){
    return md5(uniqid(rand(), true));
}

function ResetPassword(){
    if (!$DB_LINK = connectDB()){
        return false;
    }
    
    $email=$_POST["email"];
    $query="SELECT * FROM usuarios WHERE email = '$email'";
    $res=mysqli_query($DB_LINK, $query);
    
    //Solo es válido si tiene una coincidencia en la base de datos
    if (mysqli_num_rows($res) == 1){
        $token = generateToken();
        $query2="UPDATE usuarios SET token='$token' WHERE email = '$email'";
        $res=mysqli_query($DB_LINK, $query2);
        ?>

        Hola, un cambio de contraseña ha sido solicitado. Si has sido tú, entra al siguiente enlace:

        <a href="reset-password.php?token=<?php echo $token; ?>">Cambiar contraseña</a>

        Si no has sido tú, ignora este correo.

        <?php
        exit;
    }
    else {
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

function showError($id_error){
    $id_error = clear($id_error);
    echo "<b><div class='error-box'>";
    switch($id_error){
        case 0:
            echo "Error " . $id_error . ": Usuario y/o email repetidos</b></div>";		
            break;
        case 1:
            echo "Error " . $id_error . ": Usuario y/o contraseña erróneos</b></div>";		
            break;
        case 2:				
            echo "Error " . $id_error . ": No estás logeado</b></div>";				
            break;
        case 3:				
            echo "Error " . $id_error . ": El registro ha fallado, revisa los datos que has introducido</b></div>";				
            break;
        case 4:				
            echo "Error " . $id_error . ": Uso de caracteres no permitidos en el nombre</b></div>";				
            break;
        case 5:				
            echo "Error " . $id_error . ": Longitud nombre excedido o no alcanza el mínimo de caracteres</b></div>";				
            break;
        case 6:				
            echo "Error " . $id_error . ": Email no valido</b></div>";				
            break;
        case 7:				
            echo "Error " . $id_error . ": Longitud del nombre usuario excedido o no alcanza el mínimo de caracteres</b></div>";				
            break;
        case 8:				
            echo "Error " . $id_error . ": La contraseña tiene que ser al menos de 6 caracteres</b></div>";				
            break;
        default:
            echo "Error desconocido</b></div>";
            break;
    }
}

function logout(){ //cierre de sesion
    unset($_SESSION);
    session_destroy();
    session_start();
    session_regenerate_id(true);
}

function repeated($mail, $user, $DB_LINK){
    $query = "SELECT * FROM usuarios WHERE Correo='$mail'";
    $query2 = "SELECT * FROM usuarios WHERE Usuario='$user'";
    $res=mysqli_query($DB_LINK, $query);
    $res2=mysqli_query($DB_LINK, $query2);
    if(mysqli_num_rows($res) || mysqli_num_rows($res2)){
        header("Location: register.php?error=0"); exit;
    }
    
}

function checks($nombre, $email, $usuario, $contraseña){ //checks de tipos y longitudes de datos introducidos
    $allowed = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ- "; //caracteres permitidos para nombre y apellido
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); //elimina caracteres ilegales
    $flag = false;
    for ($i=0; $i<strlen($nombre); $i++){ //comprobamos que el nombre esté entre los caracteres permitidos
        if (strpos($allowed, substr($nombre, $i, 1))===false){
            $flag = true;
        }
    }
    if ($flag)
        header("Location:register.php?error=4"); //caracteres nombre no permitidos
    if (strlen($nombre)>40 || strlen($nombre)<15) // longitud nombre y apellido excedido o no llega minimo
        header("Location:register.php?error=5"); //longitud nombre excedido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //si no es un email valido falla
        header("Location:register.php?error=6"); //email no valido
    if (strlen($usuario)>20 || strlen($usuario)<5) 
        header("Location:register.php?error=7"); //longitud nombre usuario excedido o no llega minimo
    if (strlen($contraseña)<6)
        header("Location:register.php?error=8"); //la contraseña tiene que ser al menos de 6 caracteres
}

function search($recipe, $DB_LINK){
    $query = "SELECT * FROM recetas WHERE Nombre LIKE '%$recipe%'";
    $res = mysqli_query($DB_LINK, $query);
    if (!mysqli_num_rows($res)){
        echo "No existe ninguna receta que contenga $recipe";
    }
    else{
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<th scope=row>$row[ID]</th><br/>";
            echo "<td>$row[Usuario]</td><br/>";
            echo "<td>$row[Nombre]</td><br/>";
            echo "<td>$row[Categoría]</td><br/>";
            echo "<td>$row[Me_gusta]</td><br/>";
            echo "<td>$row[Imagen]</td><br/>";
            echo "<td>$row[Ingredientes]</td><br/>";
            echo "<td>$row[Preparación]</td><br/>";
            echo "</tr><br/>";
        }
    }
}

?>