<?php
$id = $_POST["idProvincia"];
$nombre = $_POST["provincia"];

try {
    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");
    $sql = $conn->query("INSERT INTO provincia(`id_provincia`, `nombre_provincia`) VALUES ('$id','$nombre')");
    
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $conn = null;
    header("location:provincias.php");
}
?>