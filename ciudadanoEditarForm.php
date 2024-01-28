<?php
$id = $_GET["id"];
try {
    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");
    $sql = $conn->query("SELECT * FROM `ciudadano` WHERE id_ciudadano=$id");
    
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ciudadano - Denuncias Ciudadanas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="logo.ico">

</head>
<?php
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['codigoValido'])) {
    header("Location: login.php");
    exit();
}

?>
<body>

    <div class="container-sm m-5 form">
    <h1><b>Editar Ciudadano</b></h1>
    <small class="text-body-secondary">¡Por favor editar los campos necesarios!</small>

    <div class="mt-4">
        <form action="ciudadanoEditar.php" method="post">
            
            <?php
            while ($datos = $sql->fetch_object()) {?>
                <label for="id"><b>Id</b></label>
                <input type="text" name="id" id="id" class="form-control-plaintext" readonly  value="<?= $datos->id_ciudadano?>">
                <label for="nombre"><b>Nombre</b></label>
                <input type="text" name="nombre" id="nombre" requiered value="<?= $datos->nombre_ciudadano?>">
                <label for="residencia"><b>Lugar residencia</b></label>
                <input type="text" name="residencia" id="residencia" requiered value="<?= $datos->lugar_reside?>">
                <label for="telefono"><b>Teléfono</label>
                <input type="text" name="telefono" id="telefono" requiered value="<?= $datos->telefono?>">
                <label for="correo"><b>Correo</label>
                <input type="text" name="correo" id="correo" requiered value="<?= $datos->correo_electronico?>">
                <input type="submit" value="Editar" name="submit">
            <?php }
            ?>

        </form>
    </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- Copos nieves -->
<!-- <script
        defer
        src="https://app.embed.im/snow.js"
    ></script> -->
    <footer>Copyright © - Orlie Macías</footer>
</body>
</html>