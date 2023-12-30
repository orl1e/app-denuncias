<?php
$id = $_GET["id"];
try {
    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");
    $sqlG = $conn->query("SELECT * FROM denuncia d
    INNER JOIN ciudadano c ON c.id_ciudadano = d.id_ciudadano
    INNER JOIN provincia p ON p.id_provincia = d.id_provincia
    INNER JOIN categoria ca ON ca.id_categoria = d.id_categoria
    WHERE id_denuncia=$id");
    
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Denuncia - Denuncias Ciudadanas</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <h1><b>Editar Denuncia</b></h1>
    <small class="text-body-secondary">¡Por favor editar los campos necesarios!</small>

    <div class="mt-4">
        <form action="denunciaEditar.php" method="post">
            
            <?php
            while ($datosDefault = $sqlG->fetch_object()) {?>
                <label><b>ID Denuncia</b></label>
                <input type="text" name="idDenuncia" id="id" class="form-control-plaintext" readonly  value="<?= $datosDefault->id_denuncia?>" required>

                <label><b>Descripción</b></label>
                <textarea class="form-control" id="miTextarea" name="descripcion" rows="2" required><?= $datosDefault->description_denuncia?></textarea>
                <p>Caracteres restantes: <span id="caracteresRestantes">150</span></p>

                <label><b>ID Ciudadano</b></label>
                <select class="form-select" name="idCiudadano" id="" required>
                    <option value="<?=$datosDefault->id_ciudadano?>"><?=$datosDefault->id_ciudadano?>. <?=$datosDefault->nombre_ciudadano?></option>
                        <?php
                            $sql = "SELECT id_ciudadano, nombre_ciudadano FROM ciudadano";
                            $result=$conn->query($sql);
                            while($datos = $result->fetch_object()) { ?>
                            <option value="<?=$datos->id_ciudadano?>"><?=$datos->id_ciudadano?>. <?=$datos->nombre_ciudadano?></option>
                            <?php }
;
                        ?>
                </select>
                
                <label><b>ID Provincia</b></label>
                <select class="form-select" name="idProvincia" id="" required>
                    <option value="<?=$datosDefault->id_provincia?>"><?=$datosDefault->id_provincia?>. <?=$datosDefault->nombre_provincia?></option>
                        <?php
                            $sql = "SELECT id_provincia, nombre_provincia FROM provincia";
                            $result=$conn->query($sql);
                            while($datos = $result->fetch_object()) { ?>
                            <option value="<?=$datos->id_provincia?>"><?=$datos->id_provincia?>. <?=$datos->nombre_provincia?></option>
                            <?php }
;
                        ?>
                </select>

                <label><b>ID Categoría</b></label>
                <select class="form-select" name="idCategoria" id="" required>
                    <option value="<?=$datosDefault->id_categoria?>"><?=$datosDefault->id_categoria?>. <?=$datosDefault->nombre_categoria?></option>
                        <?php
                            $sql = "SELECT id_categoria, nombre_categoria FROM categoria";
                            $result=$conn->query($sql);
                            while($datos = $result->fetch_object()) { ?>
                            <option value="<?=$datos->id_categoria?>"><?=$datos->id_categoria?>. <?=$datos->nombre_categoria?></option>
                            <?php }
                        
                        ?>
                </select>

                <label><b>Fecha de la denuncia</b></label>
                <input type="date" class="form-control" name="fecha" id="fecha" required value="<?=$datosDefault->fecha_denuncia?>">

                <label><b>Estatus</b></label>
                <select class="form-select" name="estatus" id="" required>
                    <option selected value="<?=$datosDefault->estatus?>"><?=$datosDefault->estatus?></option>
                    <option value="A">A (Activa)</option>
                    <option value="P">P (En atención)</option>
                    <option value="C">C (Cerrada)</option>
                    <option value="D">D (Cancelada)</option>
                </select>

                <label><b>Lugar de la denuncia</b></label>
                <textarea class="form-control" id="miTextarea2" name="lugar" rows="2" required><?=$datosDefault->lugar_denuncia?></textarea>
                <p>Caracteres restantes: <span id="caracteresRestantes2">150</span></p>

                <a class="btn btn-outline-secondary" href="denuncias.php" role="button">Regresar</a>
                <input type="submit" value="Editar" name="submit">
                
            <?php }
            ?>

        </form>
    </div>


    </div>

<!-- Script Limite de texto en textarea de descripcion -->
<script src="limitText.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<!-- Copos nieves -->
<script
        defer
        src="https://app.embed.im/snow.js"
    ></script>
    <footer>Copyright © - Orlie Macías</footer>
</body>
</html>