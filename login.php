<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="logo.ico">

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

    <div class="container" id="container">
        <?php

            if (isset($_GET['error'])) {
            $mensajeError = urldecode($_GET['error']);
            echo '<p style="color: red;">' . $_SESSION['mensajeError'] . '</p>';
            } ?>
        <div class="form-container sign-up">
            <form action="createAccount.php" method="post">
                <h1><b>Crear cuenta</b></h1>
                <small class="text-body-secondary">Ingresa tus datos para crear tu cuenta.</small>
                <input type="text" name="nombre" placeholder="Ingrese su nombre de usuario" autofocus required>
                <input type="text" name="correo" placeholder="Ingrese su correo" required>
                <input type="password" name="password" placeholder="Ingrese su contraseña" required>
                <input type="submit" value="Crear cuenta" name="submit">
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="loginValidation.php" method="post">
                <h1><b>Inicio de sesión</b></h1>
                <small class="text-body-secondary">Inicia sesión para usar la aplicación.</small>
                <input type="text" name="nombre" placeholder="Ingrese su nombre de usuario" autofocus>
                <input type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                <a href="#">Olvidaste tu contraseña?</a>
                <input type="submit" value="Iniciar sesión" name="submit">
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido!</h1>
                    <p>Introduce tus credenciales para usar el sitio 🚀</p>
                    <button class="hidden" id="login">Iniciar sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Nuevo por aquí?</h1>
                    <p>Registrate para disfrutar el sitio 😁</p>
                    <button class="hidden" id="register">Crear cuenta</button>
                </div>
            </div>
        </div>

    </div>

    <footer>Derechos Reservados © Orlie Macías</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        document.addEventListener('DOMContentLoaded', function () {
            registerBtn.addEventListener('click', () => {
            container.classList.add("active");
            });

            loginBtn.addEventListener('click', () => {
                container.classList.remove("active");
            });
        });
        
    </script>
</body>
</html>