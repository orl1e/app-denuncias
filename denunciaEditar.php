<?php
try {
    $id_denuncia = $_POST["idDenuncia"];
    $descripcion = $_POST["descripcion"];
    $id_ciudadano = $_POST["idCiudadano"];
    $id_provincia = $_POST["idProvincia"];
    $id_categoria = $_POST["idCategoria"];
    $fecha = $_POST["fecha"];
    $estatus = $_POST["estatus"];
    $lugar = $_POST["lugar"];

    //echo $id;
    // echo $nombre;
    // echo $residencia;
    // echo $telefono;
    // echo $correo;

    $conn = new mysqli("localhost", "root", "", "clinica");
    $conn->set_charset("utf8");

    $sql = "UPDATE denuncia 
    SET description_denuncia=?,id_ciudadano=?, id_provincia=?, id_categoria=?, fecha_denuncia=?, estatus=?, lugar_denuncia=?
    WHERE id_denuncia =?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    echo "Consulta preparada: " . $sql;
    $stmt->bind_param("ssssssss", $descripcion, $id_ciudadano, $id_provincia, $id_categoria, $fecha, $estatus, $lugar, $id_denuncia);
    $stmt->execute();

    if ($stmt == 1) {
        header("Location: denuncias.php");
    }

} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
} finally{
    $stmt->close(); // Cerrar la declaración preparada
    $conn->close(); // Cerrar la conexión
}
?>
