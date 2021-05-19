<?php
    include_once ("functions.php");
    
    if (!isLoggedIn()){
        header("Location: index.php?error=2");
        exit;
    }

    $IDComprobar=$_GET["ID"];
    $UsuarioActual=$_SESSION["username"];
    $query2 = "SELECT * FROM likes WHERE IDReceta='$IDComprobar' AND Nombre_usuario='$UsuarioActual'";
    $res2 = mysqli_query(connectDB(), $query2);
    $numrows = mysqli_num_rows($res2);

    
    if (isset($_GET["ID"]) && $_GET["ID"]==""){
        
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $new_link = $actual_link . $_SESSION['id'];
        header("Location: $new_link");
        
    }

    if (isset($_GET["ID"]) || ($_GET["liked"]==true)){ 
        $_SESSION['id'] = $_GET["ID"];
        $id = $_SESSION['id'];
        $query = "SELECT * from recetas WHERE ID = '$id'";
        $res = mysqli_query(connectDB(),$query);
        $row = mysqli_fetch_array($res);
    }
    ///////////////////gestion de likes////////////////
    
    if (isset($_GET["liked"]) && $id!=null){
        hasLiked($id, $_SESSION["username"]);
    }
    $heart_class = likeDislike($numrows, $heart_class);
    /////////////////////////////////////////////////////
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
    <script type="text/javascript" src="./scripts/see-recipe.js"></script>
    <title> <?php echo $row["Nombre"] ?> </title>
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
            <b><a href="./new-recipe.php">Nueva receta</a></b>
            <b><a href="./main-menu.php?order=liked">Más populares</a></b>
            <b><a href="./main-menu.php?order=recent">Más recientes</a></b>
            <b><a href="./categories.php">Categorías</a></b>
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

        <div id="see-recipe-btns" class="recipe-likes">
            <?php
            if(showDeleteButton($_SESSION["id"])){
            ?>
             <!---BOTÓN DE BORRAR -->
             <a href="main-menu.php?deleted=<?php echo $_SESSION["id"] ?>" class="remove-btn">
                <i class="fas fa-trash-alt"></i>
            </a>
            <?php
            }
            ?>
           

            <div class="like-divs">
            <div class="off like-counter">
                <?php echo howManyLikes($id); ?>
            </div>

            <div id="1" class="like-btn">
                <i id="heart-btn" class="<?php echo $heart_class; ?> fa-heart"></i>
            </div>
            </div>

        </div>

        <div id="ingredients">
        <b>Ingredientes</b><hr/>
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
        <b>Preparación</b><hr/>
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