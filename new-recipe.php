<?php
    include_once ("functions.php");
    if (!isLoggedIn()){
        header("Location: index.php?error=2");
        exit;
    }
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