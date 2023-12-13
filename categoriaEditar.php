<?php
try {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $entidad = $_POST["entidad"];
    $correo = $_POST["correo"];

    //echo $id;
    //echo $nombre;


    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");

    $sql = "UPDATE categoria
    SET nombre_categoria=?, entidad_responsable=?, correo=?
    WHERE id_categoria=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    // echo "Consulta preparada: " . $sql;
    $stmt->bind_param("ssss", $nombre, $entidad, $correo, $id);
    $stmt->execute();

    if ($stmt == 1) {
        header("Location: categorias.php");
    }

} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $stmt->close(); // Cerrar la declaración preparada
    $conn->close(); // Cerrar la conexión
}
?>
