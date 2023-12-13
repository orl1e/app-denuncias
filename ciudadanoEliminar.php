<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar</title>
</head>
<?php
    $id = $_GET["id"];
    try {
        $conn = new mysqli("localhost", "root", "", "clinica");
        $conn->set_charset("utf8");
        $sql = "DELETE FROM ciudadano WHERE id_ciudadano = ?";
        $result = $conn->prepare($sql);
        $result->execute([$id]);
        
    } catch (Exception $e) {
        die('Error: ' . $e->GetMessage());
    } finally{
        $conn->close();
        header("location:ciudadanos.php");
    }
?>
</html>
