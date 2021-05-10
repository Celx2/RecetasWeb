<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/ordenadores.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">    
    <title>Login</title>
</head>
<body>

<div class="container" id="c1">

    <div class="register-box">       
        
        <div class="title-box">
            <h1 class="title">El Título</h1>
        </div>

        <div class="text-box">
            <h2 class="text">¡Empieza ahora a descubrir miles de recetas!</h2>
        </div>

        <form action="register.php" method="POST">

            <div class="div-login-input">
                <input type="text" class="login-input" placeholder="Nombre completo" name="name" required/>
            </div>

            <div class="div-login-input">
                <input type="text" class="login-input" placeholder="Correo electrónico" name="email" required/>
            </div>

            <div class="div-login-input">
                <input type="text" class="login-input" placeholder="Nombre de usuario" name="username" required/>
            </div>

            <div class="div-login-input">
                <input type="password" class="login-input" placeholder="Contraseña" name="password" required/>
            </div>

            <div class="">
                <button class="btn" type="submit" id="login-btn">Registrarme</button>
            </div>
        </form>

        <div class="politics-text">
            <p>
                Al registrarte, aceptas nuestras Condiciones. Obtén más información sobre cómo recopilamos, 
                usamos y compartimos tu información en la Política de datos, así como el uso que hacemos de
                 las cookies y tecnologías similares en nuestra Política de cookies.
            </p>
        </div>        

    </div>

    <div class="register-sug">

        <div class="register-box-text">
            ¿Tienes cuenta? <a href="index.php">Inicia sesión</a>
        </div>

    </div>

</div>

</body>
</html>