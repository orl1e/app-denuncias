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
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location:login.php");
    exit();
}
	if(isset($_SESSION["usuario"]) && isset($_SESSION['codigoValido'])){
		header("Location:index.php");
        exit();
	}?>

<body>

    <div class="container-sm m-5 form">
    <h1><b>Verificación SMS</b></h1>
    <small class="text-body-secondary">Ingresa el código SMS para autenticarte..</small>

    <div class="mt-4">
        <form action="multifactorValidation.php" method="post">
            <label for="codigo"><b>Código de verificación.</b></label>
            <input type="number" name="codigo2FA" id="codigo">
            <input type="submit" value="Verificar" name="submit">
        </form>
    </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>