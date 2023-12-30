<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Denuncias Ciudadanas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="icon" href="logo.ico">

</head>
<?php
	session_start();
	if(!isset($_SESSION["usuario"]) && !isset($_SESSION['codigoValido'])){
		header("Location:login.php");
        exit();
	}
?>
<body>
<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
  <div class="container-sm">
    <a class="navbar-brand" href="index.php">Denuncias Ciudadanas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administrar
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="ciudadanos.php">Ciudadanos</a></li>
            <li><a class="dropdown-item" href="denuncias.php">Denuncias</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="categorias.php">Categorias</a></li>
            <li><a class="dropdown-item" href="provincias.php">Provincias</a></li>
          </ul>
        </li>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Consultas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="denunciasCategoria.php">Denuncias por Categoría</a></li>
            <li><a class="dropdown-item" href="denunciasProvincia.php">Denuncias por Provincia</a></li>
            <li><a class="dropdown-item" href="denunciasCiudadano.php">Denuncias por ciudadano</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-sm content">
  <div class="text">
    <?php
          echo "<h1><strong>Bienvenido ".ucwords($_SESSION["usuario"]).". Felices fiestas🎄</strong></h1>";
      ?>
    <div class="textAnimation">
      <h5>¿Qué harémos hoy?</h5>
      <div id="textoAnimado"></div>
    </div>
  </div>

  <div class="clock">
      <h1 id="time">00:00:00</h1>
      <p id="date">0 mes 0000</p>
  </div>
</div>

<footer>Copyright © - Orlie Macías</footer>


<!-- Copos nieves -->
<script
        defer
        src="https://app.embed.im/snow.js"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Script reloj -->
    <script>
        const time = document.getElementById('time');
        const date = document.getElementById('date');

        const nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre","Diciembre"];

        const interval = setInterval(() => {
            const local = new Date();

            let day = local.getDate(),month = local.getMonth(),year = local.getFullYear();

            time.innerHTML = local.toLocaleTimeString();
            date.innerHTML = `${day} ${nombresMeses[month]} ${year}`;
        },100)
    </script>
    <!-- Script cambiar texto -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const textos = ["¿Registrar un ciudadano?", "¿Registrar una denuncia?", "¿Eliminar una denuncia?", "¿Mi primera chamba?"];
        let indiceTexto = 0;
        const elementoTexto = document.getElementById("textoAnimado");

        function cambiarTexto() {
          elementoTexto.style.opacity = 0;
          setTimeout(function() {
            elementoTexto.textContent = textos[indiceTexto];
            elementoTexto.style.opacity = 1;
            indiceTexto = (indiceTexto + 1) % textos.length;
          },1000);

        }

        // Cambiar el texto cada 3 segundos
        setInterval(cambiarTexto, 3000);
        cambiarTexto();
      });
    </script>
</body>
</html>