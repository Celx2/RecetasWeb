<?php
session_start();
error_reporting(E_ERROR | E_PARSE); //para evitar todos los warnings, pero enseñar errores

define("DB_HOST","localhost");

define("DB_USER","admin"); 
//define("DB_USER","id16810550_admin");

define("DB_PASS","admin");
//define("DB_PASS","8P&H9bru&zePv");

define("DB_NAME","proyectofinal");
//define("DB_NAME","id16810550_proyectofinal");


function connectDB(){
    $DB_LINK = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    return $DB_LINK;
}

function clear ($value){
    $link = connectDB();
    return mysqli_real_escape_string($link, htmlspecialchars($value));

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

//Extraer extensión
function extraerExtension($imagensubida, $lista_blanca_extension=array("image/x.png", "image/gif", "image/jpeg", "image/jpg")){
    $extension=$imagensubida;
    if(in_array($extension, $lista_blanca_extension)){
        switch($extension){
            case "image/x.png":
                $extraccion=".png";
            break;
            case "image/gif":
                $extraccion=".gif";
            break;
            case "image/jpeg":
                $extraccion= ".jpeg";
            break;
            case "image/jpg":
                $extraccion=".jpg";
            break;
        }
    }
    else $extraccion=".notvalid";
    return $extraccion;
}

function moverImagen($imagen, $nombreImagen){
    $ruta="pictures/$nombreImagen";
    rename($imagen, $ruta);
    return $ruta;
}

//Comprobación de extensión de la imagen de la receta
function checkExtension($extension, $lista_blanca_extension = array(".png", ".gif", ".jpeg", ".jpg")){
    if(!in_array($extension, $lista_blanca_extension)){
        header("Location: new-recipe.php?error=10");
    }
}

function resetPassword(){
    if (!$DB_LINK = connectDB()){
        return false;
    }
    
    $email=$_POST["email"];
    $query="SELECT * FROM usuarios WHERE Correo = '$email'";
    $res=mysqli_query($DB_LINK, $query);
    
    //Solo es válido si tiene una coincidencia en la base de datos
    if (mysqli_num_rows($res) == 1){
        $token = generateToken();
        $query2="UPDATE usuarios SET token='$token' WHERE Correo = '$email'";
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
        case 9:				
            echo "Error " . $id_error . ": Error al buscar el correo electrónico</b></div>";				
            break;
        case 10:				
            echo "Error " . $id_error . ": La extensión no es valida, por favor, introduce una imagen</b></div>";				
            break;
        case 11:				
            echo "Error " . $id_error . ": No puedes realizar esta acción</b></div>";				
            break;
        case 12:				
            echo "Error " . $id_error . ": Categoría no válida</b></div>";				
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
    $allowed = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZáéíóúÁÉÍÓÚ "; //caracteres permitidos para nombre y apellido 
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

function search($recipe, $DB_LINK){ //busca recetas que contengan el nombre buscado en main-menu.php
    $query = "SELECT * FROM recetas WHERE Nombre LIKE '%$recipe%'";
    $res = mysqli_query($DB_LINK, $query);
    if (!mysqli_num_rows($res)){
        ?>
        <div class="recipe-not-found">
            <b>No existe ninguna receta que contenga <?php echo $recipe?>.</b>
        </div>
        <?php
    }
    else{
        while ($row = mysqli_fetch_array($res)) {
            ?>
    
            <div class="recipe-card">
            <div class="recipe-card-body">
        
                <div class="recipe-picture">
                    <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
                </div>
    
                <div class="recipe-title">
                    <h3> <?php echo $row["Nombre"] ?> </h3>
                </div>
    
                <div class="recipe-type">
                    <h4> <?php echo $row["Categoría"] ?> </h4>
                </div>
    
                <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                        <?php echo howManyLikes($row["ID"]) ?>
                    </div>
    
                    <div id="<?php echo $row["ID"] ?>" class="like-btn">
                        <i id="heart-btn" class="far fa-heart"></i>
                    </div>
                
                    <div class="see-btn">
                        <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                            <i id="eye-btn" class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
    
                <div class="recipe-author">
                    Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
                </div>
    
            </div>
            </div>
    
            <?php
        }
    }
}

function mainMenu($DB_LINK){ //busca recetas que contengan el nombre buscado en main-menu.php
    $query = "SELECT * FROM recetas ORDER BY ID DESC";
    $res = mysqli_query($DB_LINK, $query);
    
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
}

function liked($DB_LINK){ //muestra recetas ordenadas por likes descendente
    $query = "SELECT * FROM recetas ORDER BY Me_gusta DESC";
    $res = mysqli_query($DB_LINK, $query);
    
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
}

function howManyLikes ($recipeID){
    $query = "SELECT * FROM likes WHERE IDReceta='$recipeID'";
    $res = mysqli_query(connectDB(), $query);
    $likes = mysqli_num_rows($res);
    $query2 = "UPDATE recetas SET Me_gusta = $likes WHERE ID='$recipeID'";
    $res2 = mysqli_query(connectDB(), $query2);
    return $likes;
}

function hasLiked($recipeID, $username){    
    $query = "SELECT * FROM likes WHERE IDReceta='$recipeID' AND Nombre_usuario='$username'";
    $res = mysqli_query(connectDB(), $query);
    $row = mysqli_num_rows($res);
    if ($row==0){
        $query2="INSERT INTO likes (Nombre_usuario, IDReceta) VALUES ('$username', '$recipeID')";
        $res2=mysqli_query(connectDB(), $query2);
    }
    else{
        $query3="DELETE FROM likes WHERE IDReceta='$recipeID' AND Nombre_usuario='$username'";
        $res3=mysqli_query(connectDB(), $query3);
        }
    }

function recipesAuthor($DB_LINK){
    $author = clear($_GET["author"]);
    $query = "SELECT * FROM recetas WHERE Usuario='$author'";
    $res = mysqli_query($DB_LINK, $query);
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
    

}

function recipesAuthorLikes($DB_LINK){
    $author = clear($_GET["author"]);
    $query = "SELECT * FROM recetas WHERE Usuario='$author' ORDER BY Me_gusta DESC";
    $res = mysqli_query($DB_LINK, $query);
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
    

}

function recipesAuthorRecents($DB_LINK){
    $author = clear($_GET["author"]);
    $query = "SELECT * FROM recetas WHERE Usuario='$author' ORDER BY ID DESC";
    $res = mysqli_query($DB_LINK, $query);
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
    

}

function recipesCategory($DB_LINK){
    $category = clear($_GET["category"]);
    $query = "SELECT * FROM recetas WHERE Categoría='$category'";
    $res = mysqli_query($DB_LINK, $query);
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
    

}

function recipesCategoryLikes($DB_LINK){
    $category = clear($_GET["category"]);
    $query = "SELECT * FROM recetas WHERE Categoría='$category' ORDER BY Me_gusta DESC";
    $res = mysqli_query($DB_LINK, $query);
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
    

}

function recipesCategoryRecents($DB_LINK){
    $category = clear($_GET["category"]);
    $query = "SELECT * FROM recetas WHERE Categoría='$category' ORDER BY ID DESC";
    $res = mysqli_query($DB_LINK, $query);
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="<?php echo $row['Imagen'];?>"/>
            </div>

            <div class="recipe-title">
                <h3> <?php echo $row["Nombre"] ?> </h3>
            </div>

            <div class="recipe-type">
                <h4> <?php echo $row["Categoría"] ?> </h4>
            </div>

            <div class="recipe-likes" id="main-menu">
                <div class="off like-counter" id="counter-main-menu">
                    <b><?php echo howManyLikes($row["ID"]) ?></b> Me gusta
                </div>

                <div class="see-btn">
                    <a href="./see-recipe.php?ID=<?php echo $row["ID"] ?>">
                        <i id="eye-btn" class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a href="main-menu.php?author=<?php echo $row["Usuario"]?>"> <?php echo $row["Usuario"] ?> </a>
            </div>

        </div>
        </div>

        <?php
    }
    

}
function showDeleteButton($recipeID){
    $query="SELECT Usuario FROM recetas WHERE ID='$recipeID'";
    $res=mysqli_query(connectDB(), $query);
    $user = mysqli_fetch_array($res);
    if ($_SESSION["username"]==$user["Usuario"]){
        return true;
    }else{
        return false;
    }    
}

function deleteRecipe($recipeID){
    $Usuario=$_SESSION["username"];
    $query2="DELETE FROM recetas WHERE Usuario='$Usuario' AND ID='$recipeID'";
    mysqli_query(connectDB(), $query2);
}

function checkCategory(){
    $recipeType = $_POST["recipe-type"];
    $white_list=array("Desayunos", "Aperitivos", "Carnes", "Pescados", "Sopas", "Pastas", "Arroces", "Legumbres", "Ensaladas", "Salsas", 
    "Postres", "Bebidas", "Fitness", "Vegetariano", "Vegano", "Otros");
    if(!in_array($recipeType, $white_list)){
        header("Location: new-recipe.php?error=12");
        exit;
    }
}

function likeDislike($numrows, $heart_class){

    if ($numrows!=0 && !isset($_GET["liked"])){
        $heart_class = "fas";
    }
    elseif($numrows==0 && $heart_class!="far"){
        $heart_class = "far";    
    }

    if(isset($_GET["liked"])){
        if($heart_class == "far") $heart_class = "fas";
        else $heart_class = "far";
    }
    return $heart_class;
}

function OrderMainMenu(){
    if (isset($_GET["recipe"]) && $_GET["recipe"]!=""){
        $recipe = clear($_GET["recipe"]);
        search($recipe,connectDB());
        exit;
    }
    elseif (!isset($_GET["category"]) && !isset($_GET["author"]) && isset($_GET["order"]) && $_GET["order"]=="liked"){
        liked(connectDB());
        exit;
    }
    elseif (isset($_GET["author"])){
        if ($_GET["order"]=="liked"){
            recipesAuthorLikes(connectDB());
            exit;
        }
        elseif ($_GET["order"]=="recent"){
            recipesAuthorRecents(connectDB());
            exit;
        }
        else {
            recipesAuthor(connectDB());
            exit;
        }
    }

    elseif (isset($_GET["category"])){
        if ($_GET["order"]=="liked"){
            recipesCategoryLikes(connectDB());
            exit;
        }
        elseif ($_GET["order"]=="recent"){
            recipesCategoryRecents(connectDB());
            exit;
        }
        else {
            recipesCategory(connectDB());
            exit;
        }
    }

    else{
        mainMenu(connectDB());
        exit;
    } 
}

?>