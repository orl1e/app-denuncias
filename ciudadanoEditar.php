<?php
try {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $residencia = $_POST["residencia"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];

    //echo $id;
    // echo $nombre;
    // echo $residencia;
    // echo $telefono;
    // echo $correo;

    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");

    $sql = "UPDATE ciudadano 
    SET nombre_ciudadano=?,lugar_reside=?, telefono=?, correo_electronico=?
    WHERE id_ciudadano =?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    // echo "Consulta preparada: " . $sql;
    $stmt->bind_param("sssss", $nombre, $residencia, $telefono, $correo, $id);
    $stmt->execute();

    if ($stmt == 1) {
        header("Location: ciudadanos.php");
    }

} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $stmt->close(); // Cerrar la declaración preparada
    $conn->close(); // Cerrar la conexión
}
?>
