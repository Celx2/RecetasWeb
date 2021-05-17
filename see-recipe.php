<?php
    include_once ("functions.php");
    if (!isLoggedIn()){
        header("Location: index.php?error=2");
        exit;
    }
    $id = $_GET["ID"];
    $query = "SELECT * from recetas WHERE ID='$id'";
    $res = mysqli_query(connectDB(),$query);
    $row = mysqli_fetch_array($res)
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
    <script src="https://kit.fontawesome.com/11e0b18f8c.js" crossorigin="anonymous"></script>
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="./scripts/see-recipe.js"></script>
    <title> <?php echo $row["Nombre"] ?> </title>
</head>
<body>

    <div class="container">

    <nav>

        <div class="nav-user">
        <!-- arreglar nombre usuario logeado -->
            <user><?php echo $_SESSION["username"]; ?></user> | <a class="logout" href="index.php?logout=yes">Cerrar sesión</a>
        </div>

        <div class="nav-recipe">
            <h1>HappyApple!</h1>
        </div>
        
        <form action="main-menu.php" method="GET">
            <div class="nav-search">
                <input id="search-input" type="text" name="recipe" placeholder="Buscar receta"/>
            </div>
        </form>

        <div class="sub-nav">
            <b><a href="./main-menu.php?order=liked">Recetas más amadas</a></b>
        
            <b><a href="./new-recipe.php">Nueva receta</a></b>
        
            <b><a href="./main-menu.php?order=recent">Recetas más recientes</a></b>
        </div>

    </nav>

    <div class="recipe-box">

        <div class="return-btn">
            <a href="main-menu.php"><button type="button" id="new-recipe-return" class="btn">Volver</button></a>            
        </div>

        <div class="recipe-box-line">
            <hr>
        </div>

        <div id="title">
        <label>Receta:</label>
            <h1><?php echo $row["Nombre"] ?></h1>
        </div>

        <div id="picture">
            <img src="<?php echo $row['Imagen'] ?>"/>
        </div>

        <div id="type">
        <label>Categoría:</label>
        <h2><?php echo $row["Categoría"] ?></h2>
        </div>

        <div id="author">
        <label>Autor:</label>
        <h3><?php echo $row["Usuario"] ?></h3>
        </div>

        <div id="likes-see-recipe" class="recipe-likes">

            <div class="off like-counter">
                16
            </div>

            <div id="1" class="like-btn">
                <i id="heart-btn" class="far fa-heart"></i>
            </div>

        </div>

        <div id="ingredients">
        <b>Ingredientes:</b>
            <h3>
            <?php
            $file = fopen($row["Ingredientes"], "r");

            while(!feof($file)) {

            echo fgets($file). "<br />";

            }

            fclose($file);
            ?>
            </h3>
        </div>

        <div id="preparation">
        <b>Preparación:</b>
        <h4>
        <?php
            $file = fopen($row["Preparación"], "r");

            while(!feof($file)) {

            echo fgets($file). "<br />";

            }

            fclose($file);
            ?>
        </h4>

    </div>

    </div>
    
</body>
</html>