<?php
	session_start();
	if(!isset($_SESSION["usuario"]) && !isset($_SESSION['codigoValido'])){
		header("Location:login.php");
        exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncias por Categoría | Denuncias Ciudadanas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/ciudadanos.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="logo.ico">
</head>
<body>

<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
  <div class="container-sm">
    <a class="navbar-brand" href="">Consulta por categoría</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link" href="index.php" role="button">
            Inicio
          </a>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container-lg ciudadanos">
        <?php
            echo '<p style="color: #d6f3ff;">Hola '.ucwords($_SESSION["usuario"]). '. Aquí puedes buscar denuncias por categorías.<br><br></p>';
        ?>
            <div class="formCiudadano form">
            <div class="mt-4">
            <form class="needs-validation" action="" method="post" >
                <div class="row">
                    <h3 style="color:#d6f3ff;">Filtrar por categoría</h3>
                    <div class="col-auto">
                        <select class="form-select" name="idCategoria" id="" required>
                            <option value="0">ID Categoria</option>
                            <?php
                             $conn = new mysqli("localhost", "root", "", "clinica");
                             $conn->set_charset("utf8");
                             $sql = "SELECT id_categoria,nombre_categoria FROM categoria";
                             $result=$conn->query($sql);
                             while($datos = $result->fetch_object()) { ?>
                             <option value="<?=$datos->id_categoria?>"><?=$datos->id_categoria?>. <?=$datos->nombre_categoria?></option>
                            <?php }
                            ?>
                        </select>
                    </div>

                </div>
                
                <input type="submit" value="Buscar" name="submit">
            </form>
            </div>
        </div>

        <div class="ciudadano">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Id Ciudadano</th>
                        <th scope="col">Id Provincia</th>
                        <th scope="col">Id Categoria</th>
                        <th scope="col">Fecha Denuncia</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Lugar Denuncia</th>
                        </tr>
                    </thead>
        <?php
            try {
                $categoriaFiltrada = $_POST["idCategoria"];
                $conn = new mysqli("localhost", "root", "", "clinica");
                $conn->set_charset("utf8");
                $sql = "SELECT * FROM denuncia d INNER JOIN categoria c ON c.id_categoria = d.id_categoria INNER JOIN provincia p ON p.id_provincia = d.id_provincia INNER JOIN ciudadano ci ON ci.id_ciudadano = d.id_ciudadano WHERE d.id_categoria = '$categoriaFiltrada'";
                $result=$conn->query($sql);
                while($datos = $result->fetch_object()) { ?>
                    <tbody>
                        <tr>
                        <th scope="row"><?= $datos->id_denuncia?></th>
                        <td><?= $datos->description_denuncia?></td>
                        <td class="mostrar-nombre" nombre='<?=$datos->nombre_ciudadano?>'><?= $datos->id_ciudadano?></td>
                        <td class="mostrar-nombre" nombre='<?=$datos->nombre_provincia?>'><?= $datos->id_provincia?></td>
                        <td class="mostrar-nombre" nombre='<?=$datos->nombre_categoria?>'><?= $datos->id_categoria?></td>
                        <td><?= $datos->fecha_denuncia?></td>
                        <td><?= $datos->estatus?></td>
                        <td><?= $datos->lugar_denuncia?></td>
                        </tr>
                    </tbody>
        <?php }

            } catch (Exception $e) {
                die('Error: ' . $e->GetMessage());
            }?>   
                </table>
        </div>            
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Mostrar nombre de ID -->
<script>
    $(document).ready(function () {
    // Maneja el evento mouseover en los elementos con la clase 'mostrar-nombre'
    $('.mostrar-nombre').mouseover(function() {
        const nombre = $(this).attr('nombre');

        // Muestra el nombre usando SweetAlert
        Swal.fire({
            title: 'Nombre asignado al ID',
            text: nombre,
            icon: 'info',
            toast:'true',
            timer:2500,
            timerProgressBar:true,
            showConfirmButton:false,
            position: 'top-end',
        });
    });
});
</script>

<!-- Copos nieves -->
<script
        defer
        src="https://app.embed.im/snow.js"
    ></script>
    <footer>Copyright © - Orlie Macías, Abraham Guttierez, Kevin Luo </footer>
</body>
</html>