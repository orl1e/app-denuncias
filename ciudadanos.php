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
    <title>Ciudadanos | Denuncias Ciudadanas</title>
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
    <a class="navbar-brand" href="">Ciudadanos</a>
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
            echo '<p style="color: #d6f3ff;">Hola '.ucwords($_SESSION["usuario"]). '. Aquí puedes administrar los ciudadanos.<br><br></p>';
        ?>
            <div class="formCiudadano form">
            <div class="mt-4">
            <form class="needs-validation" action="ciudadanoInsertar.php" method="post">
                <div class="row">
                    <h3 style="color:#d6f3ff;">Agregar usuario</h3>
                    <div class="col">
                        <input type="text" name="id" id="id" placeholder="ID cuidadano" required>
                    </div>
                    <div class="col">
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
                    </div>
                    <div class="col">
                        <input type="text" name="residencia" id="residencia" placeholder="Lugar residencia" required>
                    </div>
                    <div class="col">
                        <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required>
                    </div>
                    <div class="col">
                        <input type="text" name="correo" id="correo" placeholder="Correo" required>
                    </div>
                </div>
                
                <input type="submit" value="Agregar" name="submit">
            </form>
            </div>
        </div>

        <div class="ciudadano">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Residencia</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
        <?php
            try {
                $conn = new mysqli("localhost", "root", "", "clinica");
                $conn->set_charset("utf8");
                $sql = "SELECT * FROM ciudadano ORDER BY id_ciudadano DESC";
                $result=$conn->query($sql);
                while($datos = $result->fetch_object()) { ?>
                    <tbody>
                        <tr>
                        <th scope="row"><?= $datos->id_ciudadano?></th>
                        <td><?= $datos->nombre_ciudadano?></td>
                        <td><?= $datos->lugar_reside?></td>
                        <td><?= $datos->telefono?></td>
                        <td><?= $datos->correo_electronico?></td>
                        <td><a href="ciudadanoEditarForm.php?id=<?=$datos->id_ciudadano?>">Editar</a>
                            <a onclick="return confirmDelete(<?=$datos->id_ciudadano?>)" href="#">Borrar</a></td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script confirmación eliminar -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
            title: "Deseas eliminar este ciudadano?",
            text: "Esta acción no es reversible!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "Cancelar",
            allowOutsideClick: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Manejar la respuesta y redirigir si es necesario
                    Swal.fire('Eliminado', 'El ciudadano ha sido eliminado', 'success').then(() => {
                        window.location.href = 'ciudadanoEliminar.php?id=' + id;
                    });
                }
            });
            return false;
        }
    </script>

<!-- Copos nieves -->
<script
        defer
        src="https://app.embed.im/snow.js"
    ></script>
    <footer>Copyright © - Orlie Macías, Abraham Guttierez, Kevin Luo </footer>
</body>
</html>