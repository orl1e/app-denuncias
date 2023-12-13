<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncias Ciudadanas</title>
</head>
<?php
try {
    session_start();
    // Obtener el código almacenado temporalmente
    $codigo2FAAlmacenado = $_SESSION['codigo2FA'];

    // Verificar el código ingresado por el usuario
    $codigo2FAUsuario = $_POST['codigo2FA'];

    if ($codigo2FAUsuario == $codigo2FAAlmacenado) {
        $_SESSION['codigoValido'] = $codigo2FAAlmacenado;
        // Código 2FA válido, permite el inicio de sesión
        header("location:index.php");
    } else {
        // Código 2FA no válido, deniega el inicio de sesión
        $_SESSION['mensajeError']="Código de validación incorrecto. Por favor, inténtalo de nuevo.";
        header("location:login.php?error=");
    }
} catch (Exception $e) {
    die("Error ".$e->getMessage());
}

?>
</html>


