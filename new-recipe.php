<?php
    
    include_once ("functions.php");
    if (!isLoggedIn()){
        header("Location: index.php?error=2");
        exit;
    }
  
    //checkeamos categoria
    if (isset($_POST["recipe-type"]))checkCategory();
    //checkeamos extension
    if (isset($_FILES["picture"]) && !isset($_GET["error"]))checkExtension(extraerExtension($_FILES["picture"]["type"]));
    ////////////////////////
    if(isset($_POST["recipe-name"]) && isset($_POST["recipe-type"]) && isset($_POST["recipe-ingredients"]) && isset($_POST["recipe-preparation"]) && !isset($_GET["error"])){ 
        $recipe_name=clear($_POST["recipe-name"]);
        $recipe_type=clear($_POST["recipe-type"]);
        $recipe_ingredients=htmlspecialchars($_POST["recipe-ingredients"]);
        $recipe_preparation=htmlspecialchars($_POST["recipe-preparation"]);
        $username=$_SESSION["username"];
        $query = "INSERT INTO recetas (Usuario, Nombre, Categoría, Me_gusta, Imagen, Ingredientes, Preparación) VALUES ('$username', '$recipe_name', '$recipe_type', 0, 0, 0, 0)";
        $res = mysqli_query(connectDB(), $query);
        $query2 = "SELECT * FROM recetas WHERE Usuario = '$username' AND Nombre = '$recipe_name'";
        $res2 = mysqli_query(connectDB(), $query2);
        $row = mysqli_fetch_array($res2);
        
        
        //Introducir una imagen
		if($_FILES["picture"]["name"]!=""){
			$nombreImagen=md5($row["ID"]).$extension;
	    	$ruta = moverImagen($_FILES["picture"]["tmp_name"],$nombreImagen);
			$picture=$nombreImagen;
		}

        //Guardar preparacion e ingredientes en los .txt correspondientes
        $ext = "$row[ID]_ingredients";
        $ext2 = "$row[ID]_preparation";
        $fichero = "recipes/$ext.txt";
        file_put_contents($fichero, $recipe_ingredients, FILE_APPEND | LOCK_EX);
        $fichero2 = "recipes/$ext2.txt";
        file_put_contents($fichero2, $recipe_preparation, FILE_APPEND | LOCK_EX);
        $query3 = "UPDATE recetas SET Imagen = '$ruta', Ingredientes = '$fichero', Preparación = '$fichero2' WHERE ID = '$row[ID]'";
        $res3 = mysqli_query(connectDB(), $query3);
        header("Location: new-recipe.php?saved=yes");
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
    <script src="https://kit.fontawesome.com/11e0b18f8c.js" crossorigin="anonymous"></script>
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="./scripts/new-recipe.js"></script>
    <title>Nueva receta</title>
</head>
<body>

<div class="container">

    <nav>   

        <div class="nav-user">
        <!-- arreglar nombre usuario logeado -->
            <user><?php echo $_SESSION["username"]; ?></user> | <a class="logout" href="index.php?logout=yes">Cerrar sesión</a>
        </div>

        <div class="nav-recipe">
            <a href="./main-menu.php"><h1>HappyApple!</h1></a>
        </div>
        
        <form action="main-menu.php" method="GET">
            <div class="nav-search">
                <input id="search-input" type="text" name="recipe" placeholder="Buscar receta"/>
            </div>
        </form>

        <div class="sub-nav">
            <b><a href="./main-menu.php?order=liked">Recetas con más likes</a></b>
        
            <b><a href="./new-recipe.php">Nueva receta</a></b>
        
            <b><a href="./main-menu.php?order=recent">Recetas más recientes</a></b>
        </div>

    </nav>

    <div class="new-recipe-box">
    <?php
            if((isset($_GET["saved"])) && $_GET["saved"] == "yes"){
        ?>
            <div class="confirm-box">
                <b>Receta añadida correctamente.</b>
            </div>
            <?php

            }
              //comprobaciones errores
            if (isset($_GET["error"]))showError($_GET["error"]);
     ?>

        <form name="form1" action="new-recipe.php" method="POST" enctype="multipart/form-data">

        <div class="new-recipe-name">
            <label for="name">Nombre: </label>
            <input type="text" name="recipe-name" required="required"/>
        </div>

        <div class="new-recipe-type">
            <label for="type">Tipo de receta: </label>
            <select name="recipe-type">
                <option>Desayunos</option>
                <option>Aperitivos</option>
                <option>Carnes</option>
                <option>Pescados</option>
                <option>Sopas</option>
                <option>Pastas</option>
                <option>Arroces</option>
                <option>Legumbres</option>
                <option>Ensaladas</option>
                <option>Salsas</option>
                <option>Postres</option>
                <option>Bebidas</option>
                <option>Fitness</option>
                <option>Vegetariano</option>
                <option>Vegano</option>
                <option>Otros</option>



            </select>
        </div>

        <div class="new-recipe-ingredients">
            <label for="ingredients">Ingredientes: </label>
            <textarea type="text" name="recipe-ingredients" required="required"></textarea>
        </div>

        <div class="new-recipe-preparation">
            <label for="preparation">Preparación: </label>
            <textarea type="text" name="recipe-preparation" required="required"></textarea>
        </div>

        <div class="new-recipe-picture">
            <label for="picture">Suba una imagen:</label>
            <input type="file" name="picture" accept="image/x-png, image/gif, image/jpeg, image/jpg" required="required"/>
        </div>

        <div class="new-recipe-btns">
            <a href="main-menu.php"><button type="button" id="new-recipe-return" class="btn">Volver</button></a>
            <input id="new-recipe-submit" type="submit" name="uploadBtn" class="btn" value="Guardar">
        </div>

        </form>

    </div>



</div>
    
</body>
</html>