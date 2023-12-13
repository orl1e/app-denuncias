<?php
$id_denuncia = $_POST["idDenuncia"];
$descripcion = $_POST["descripcion"];
$id_ciudadano = $_POST["idCiudadano"];
$id_provincia = $_POST["idProvincia"];
$id_categoria = $_POST["idCategoria"];
$fecha = $_POST["fecha"];
$estatus = $_POST["estatus"];
$lugar = $_POST["lugar"];

// echo $id_denuncia;
// echo $descripcion;
// echo $id_ciudadano;
// echo $id_provincia;
// echo $id_categoria;
// echo $fecha;
// echo $estatus;
// echo $lugar;

try {
    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");
    $sql = "INSERT INTO `denuncia`(`id_denuncia`, `description_denuncia`, `id_cuidadano`, `id_provincia`, `id_categoria`, `fecha_denuncia`, `estatus`, `lugar_denuncia`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_denuncia, $descripcion, $id_ciudadano, $id_provincia, $id_categoria, $fecha, $estatus, $lugar]);
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $stmt->close();
    $conn->close();
    header("location:denuncias.php");
}
?>