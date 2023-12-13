<?php
try {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];

    //echo $id;
    //echo $nombre;


    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");

    $sql = "UPDATE provincia
    SET nombre_provincia=?
    WHERE id_provincia =?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    // echo "Consulta preparada: " . $sql;
    $stmt->bind_param("ss", $nombre, $id);
    $stmt->execute();

    if ($stmt == 1) {
        header("Location: provincias.php");
    }

} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $stmt->close(); // Cerrar la declaración preparada
    $conn->close(); // Cerrar la conexión
}
?>
