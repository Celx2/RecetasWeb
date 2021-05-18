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
    <script type="text/javascript" src="./scripts/main-menu.js"></script>
    <title>HappyApple!</title>
</head>

<body>

<div class="container">

    <nav>
        <div class="nav-user">
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


    <div class="recipes-box">

	<?php 
            if (isset($_GET["recipe"]) && $_GET["recipe"]!=""){
                $recipe = clear($_GET["recipe"]);
                search($recipe,connectDB());
            }
            elseif (isset($_GET["order"]) && $_GET["order"]=="liked"){
                liked(connectDB());
            }
            elseif (isset($_GET["author"])){
                recipesAuthor(connectDB());
            }
            else{
                mainMenu(connectDB());
            } 
    ?>

    </div>
</div>

</body>
</html>