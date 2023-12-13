<?php
$id = $_POST["idCategoria"];
$nombre = $_POST["nombre"];
$entidad = $_POST["entidad"];
$correo = $_POST["correo"];

try {
    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");
    $sql = $conn->query("INSERT INTO categoria(id_categoria, nombre_categoria, entidad_responsable, correo) VALUES ('$id','$nombre','$entidad','$correo')");
    
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $conn = null;
    header("location:categorias.php");
}
?>