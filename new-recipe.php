<?php
    include_once ("functions.php");
    if (!isLoggedIn()){
        header("Location: index.php?error=2");
        exit;
    }
    if(isset($_POST["recipe-name"]) && isset($_POST["recipe-name"]) && isset($_POST["recipe-name"]) && isset($_POST["recipe-name"])){

    
    $recipe_name=clear($_POST["recipe-name"]);
    $recipe_type=clear($_POST["recipe-type"]);
    $recipe_ingredients=clear($_POST["recipe-ingredients"]);
    $recipe_preparation=clear($_POST["recipe-preparation"]);
}
    $id=$_SESSION["id"];
    
    $query = "INSERT INTO recetas (Usuario, Nombre, Categoría, Me_gusta, Imagen, Ingredientes, Preparación) VALUES (0, '$recipe_name', '$recipe_type', 0, 0, 0, 0)";
    $res = mysqli_query($DB_LINK, $query);

    $query2 = "SELECT ID FROM usuarios WHERE Usuario = '$id' AND Nombre = '$recipe_name'";
    $recipe_id = mysqli_query($DB_LINK, $query2);

    //Introducir una imagen
		if($_FILES["picture"]["name"]!=""){
			$extension=extraerExtension($_FILES["picture"]["type"]);
			$nombreImagen=md5($recipe_id).$extension;
			moverImagen($_FILES["picture"]["tmp_name"],$nombreImagen);
			$picture=$nombreImagen;
			checkExtension($extension);
		}
    //Guardar datos en los archivos
    





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
            <user><?php echo $_SESSION["username"]; ?></user> | <a class="logout" href="index.php?logout=yes">Cerrar sesión</a>
        </div>

        <div class="nav-recipe">
            <a href="new-recipe.php">¡NUEVA RECETA!</a>
        </div>

        <div class="nav-search">
            <input id="search-input" type="text" placeholder="Buscar receta"/>
        </div>

    </nav>

    <div class="new-recipe-box">

        <form action="" method="">

        <div class="new-recipe-name">
            <label for="name">Nombre: </label>
            <input type="text" name="recipe-name" required/>
        </div>

        <div class="new-recipe-type">
            <label for="type">Tipo de receta: </label>
            <select name="recipe-type">
                <option>Uno</option>
                <option>Dos</option>
                <option>Tres</option>
                <option>Cuatro</option>
            </select>
        </div>

        <div class="new-recipe-ingredients">
            <label for="ingredients">Ingredientes: </label>
            <input type="text" name="recipe-ingredients" required/>
        </div>

        <div class="new-recipe-preparation">
            <label for="preparation">Preparación: </label>
            <textarea type="text" name="recipe-preparation" required></textarea>
        </div>

        <div class="new-recipe-picture">
            <label for="picture">Suba una imagen:</label>
            <input type="file" name="picture"/>
        </div>

        <div class="new-recipe-btns">
            <input id="new-recipe-submit" type="submit" name="uploadBtn" class="btn" value="Volver">
            <input id="new-recipe-submit" type="submit" name="uploadBtn" class="btn" value="Guardar">
        </div>

        </form>

    </div>

</div>
    
</body>
</html>