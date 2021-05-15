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
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="./scripts/see-recipe.js"></script>
    <title> - </title>
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
        
        <form action="main-menu.php" method="POST">
            <div class="nav-search">
                <input id="search-input" type="text" name="recipe" placeholder="Buscar receta"/>
            </div>
        </form>

        <div class="sub-nav">
            <b>Recetas más amadas</b>
        
            <b><a href="./new-recipe.php">Nueva receta</a></b>
        
            <b>Recetas más recientes</b>
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
            <h1>Brownie saludable</h1>
        </div>

        <div id="picture">
            <img src="./pictures/brownie.jpg"/>
        </div>

        <div id="type">
            <h2>Postre</h2>
        </div>

        <div id="author">
            Receta de: <a>francis_moreno777</a>
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
            <h3>
            Plátano maduro: 180g<br/>
            Huevos L: 2<br/>
            Esencia de vainilla: 5ml<br/>
            Cacao puro: 50g<br/>
            Chocolate negro picado: 80g<br/>
            Bicarbonato sódico: 6g<br/>
            Leche o bebida vegetal: 10ml<br/>
            Sal: 1g
            </h3>
        </div>

        <div id="preparation">
        <h4>
        Precalentar el horno a 175ºC y cubrir con papel sulfurizado -de hornear- un molde cuadrado de unos 20 cm de lado. Si es más pequeño, las piezas de brownie saldrán más gruesas y algo más difíciles de cortar, pero también más jugosas.
        <br/><br/>
        Pelar los plátanos y cortarlos en trozos. Colocar en un cuenco con los huevos y batir con un tenedor, machacándolos bien, o usar una batidora. También se puede emplear un procesador de alimentos o batidora de vaso. Incorporar el resto de ingredientes, salvo el chocolate, y batir un poco más hasta que no queden grumos secos.
        <br/><br/>
        Añadir el chocolate negro picado o troceado y remover con suavidad. Llenar el molde y hornear durante unos 20 minutos. Al pinchar el centro con un palillo debe salir ligeramente manchado, pero no mojado. Dejar enfriar fuera del horno unos 10 minutos antes de desmoldar y trasladar con el propio papel a una rejilla.
        <br/><br/>
        Esperar a que se enfríe por completo antes de cortar en piezas. Se cortará mejor si lo dejamos una o dos horas en la nevera, para que se asiente la miga. Guardar en un recipiente hermético en la nevera, sobre todo si hace mucho calor.
        </div>
        </h4>

    </div>

    </div>
    
</body>
</html>