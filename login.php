<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="stylesheet" href="css/normalize.css">

</head>
<?php
// Verifica si el usuario ya está autenticado y redirige a la página principal si es así.
session_start();
if (isset($_SESSION['usuario']) && isset($_SESSION['codigoValido'])) {
    header("Location: index.php");
    exit();
}

?>
<body>

    <div class="container-sm m-5 form">
        <?php

            if (isset($_GET['error'])) {
            $mensajeError = urldecode($_GET['error']);
            echo '<p style="color: red;">' . $_SESSION['mensajeError'] . '</p>';
            } ?>
    <h1><b>Inicio de sesión</b></h1>
    <small class="text-body-secondary">Inicia sesión para usar la aplicación.</small>

    <div class="mt-4">
        <form action="loginValidation.php" method="post">
            <label for="nombre"><b>Nombre usuario</b></label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
            <label for="nombre"><b>Apellido usuario</b></label>
            <input type="text" name="apellido" id="apellido" placeholder="Ingrese su apellido">
            <label for="nombre"><b>Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Ingrese su contraseña">
            <input type="submit" value="Iniciar sesión" name="submit">
        </form>
    </div>


    </div>

    <footer>Copyright © - Orlie Macías, Abraham Guttierez, Kevin Luo </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>