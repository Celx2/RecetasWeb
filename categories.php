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
            <b><a href="./new-recipe.php">Nueva receta</a></b>
            <b><a href="./main-menu.php?order=liked">Más populares</a></b>
            <b><a href="./main-menu.php?order=recent">Más recientes</a></b>
            <b><a href="./categories.php">Categorías</a></b>
        </div>
    </nav>

    <div class="categories-box">

        <h1>Seleccione una categoría</h1>

        <div class="categorie-list">
        <a href="main-menu.php?category=Desayunos" class="categorie-box">
            Desayunos
        </a>

        <a href="main-menu.php?category=Aperitivos" class="categorie-box">
            Aperitivos
        </a>
        
        <a href="main-menu.php?category=Carnes" class="categorie-box">
            Carnes
        </a>
        
        <a href="main-menu.php?category=Pescados" class="categorie-box">
            Pescados
        </a>
        
        <a href="main-menu.php?category=Sopas" class="categorie-box">
            Sopas
        </a>
        
        <a href="main-menu.php?category=Pastas" class="categorie-box">
            Pastas
        </a>
        
        <a href="main-menu.php?category=Arroces" class="categorie-box">
            Arroces
        </a>
        
        <a href="main-menu.php?category=Legumbres" class="categorie-box">
            Legumbres
        </a>
        
        <a href="main-menu.php?category=Ensaladas" class="categorie-box">
            Ensaladas
        </a>
        
        <a href="main-menu.php?category=Salsas" class="categorie-box">
            Salsas
        </a>
        
        <a href="main-menu.php?category=Postres" class="categorie-box">
            Postres
        </a>
        
        <a href="main-menu.php?category=Bebidas" class="categorie-box">
            Bebidas
        </a>
        
        <a href="main-menu.php?category=Fitness" class="categorie-box">
            Fitness
        </a>
        
        <a href="main-menu.php?category=Vegetariano" class="categorie-box">
            Vegetariano
        </a>
        
        <a href="main-menu.php?category=Vegano" class="categorie-box">
            Vegano
        </a>
        
        <a href="main-menu.php?category=Otros" class="categorie-box">
            Otros
        </a>
        </div>
    
    </div>


</div>
    
</body>
</html>