<?php
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$residencia = $_POST["residencia"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

try {
    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");
    $sql = $conn->query("INSERT INTO `ciudadano`(`id_ciudadano`, `nombre_ciudadano`, `lugar_reside`, `telefono`, `correo_electronico`) VALUES ('$id','$nombre','$residencia','$telefono','$correo')");
    
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $conn = null;
    header("location:ciudadanos.php");
}
?>