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
    <script type="text/javascript" src="./scripts/main-menu.js"></script>
    <title>Título</title>
</head>

<body>

<div class="container">

    <nav>

        <div class="nav-user">
        <!-- arreglar nombre usuario logeado -->
            <user><?php echo $_SESSION["username"]; ?></user> | <a class="logout" href="index.php?logout=yes">Cerrar sesión</a>
        </div>

        <div class="nav-recipe">
            <b>Nueva receta</b>
        </div>

        <div class="nav-search">

            <input id="search-input" type="text" placeholder="Buscar receta"/>

            <div class="search-icon-box">
                <i id="search-icon" class="fas fa-search"></i>
            </div>

        </div>

    </nav>


    <div class="recipes-box">
    
        <div class="recipe-card">
        <div class="recipe-card-body">

            <div class="recipe-picture">
                <img class="recipeUwU" src="./pictures/brownie.jpg"/>
            </div>

            <div class="recipe-title">
                <h3>Brownie saludable</h3>
            </div>

            <div class="recipe-type">
                <h4>Postre</h4>
            </div>

            <div class="recipe-likes">

                <div class="off like-counter">
                    16
                </div>

                <div class="like-btn">
                    <i id="heart-btn" class="far fa-heart"></i>
                </div>

            </div>

            <div class="recipe-author">
                Por: <a>francis_moreno777</a>
            </div>

        </div>
        </div>
        

        <div class="recipe-card">
        <div class="recipe-card-body">

            <div class="recipe-picture">
                <img class="recipeUwU" src="./pictures/brownie.jpg"/>
            </div>

            <div class="recipe-title">
                <h3>Brownie saludable</h3>
            </div>

            <div class="recipe-type">
                <h4>Postre</h4>
            </div>

            <div class="recipe-likes">
                <div class="off like-counter">
                    2
                </div>

                <div class="like-btn">
                    <i id="heart-btn" class="far fa-heart"></i>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a>francis_moreno777</a>
            </div>

        </div>
        </div>


        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="./pictures/brownie.jpg"/>
            </div>

            <div class="recipe-title">
                <h3>Brownie saludable</h3>
            </div>

            <div class="recipe-type">
                <h4>Postre</h4>
            </div>

            <div class="recipe-likes">
                <div class="off like-counter">
                    11
                </div>

                <div class="like-btn">
                    <i id="heart-btn" class="far fa-heart"></i>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a>francis_moreno777</a>
            </div>

        </div>
        </div>

        <div class="recipe-card">
        <div class="recipe-card-body">
    
            <div class="recipe-picture">
                <img class="recipeUwU" src="./pictures/brownie.jpg"/>
            </div>

            <div class="recipe-title">
                <h3>Brownie saludable</h3>
            </div>

            <div class="recipe-type">
                <h4>Postre</h4>
            </div>

            <div class="recipe-likes">
                <div class="off like-counter">
                    26
                </div>

                <div class="like-btn">
                    <i id="heart-btn" class="far fa-heart"></i>
                </div>
            </div>

            <div class="recipe-author">
                Por: <a>francis_moreno777</a>
            </div>

        </div>
        </div>

        <div class="recipe-card">
            <div class="recipe-card-body">
        
                <div class="recipe-picture">
                    <img class="recipeUwU" src="./pictures/brownie.jpg"/>
                </div>
    
                <div class="recipe-title">
                    <h3>Brownie saludable</h3>
                </div>
    
                <div class="recipe-type">
                    <h4>Postre</h4>
                </div>
    
                <div class="recipe-likes">
                    <div class="off like-counter">
                        16
                    </div>
    
                    <div class="like-btn">
                        <i id="heart-btn" class="far fa-heart"></i>
                    </div>
                </div>
    
                <div class="recipe-author">
                    Por: <a>francis_moreno777</a>
                </div>
    
            </div>
            </div>

    </div>
</div>

</body>
</html>