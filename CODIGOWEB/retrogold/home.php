<?php
session_start();

// Verifica si el usuario inició sesión y tiene rol 'user'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'user') {
    header("Location: ../login/login.html");
    exit();
}

$nombreUsuario = $_SESSION['nombre'] ?? 'Usuario';
$username = $_SESSION['username'] ?? 'default';
$rutaPerfil = "uploads/perfiles/$username.png";
$fotoPerfil = file_exists($rutaPerfil) ? $rutaPerfil . '?v=' . time() : 'assets/fotos/usuario.png';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Retrogold-Luismi-Mateo</title>
  <link rel="stylesheet" href="assets/css/styles-home.css">
  <link rel="icon" href="assets/fotos/logo.png" type="image/png">
  <style>
    .usuario-dropdown {
      position: relative;
      display: inline-block;
      margin-right: 20px;
    }

    .usuario-dropdown span {
      font-family: 'Press Start 2P', monospace;
      color: white;
      margin-right: 10px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: rgba(0, 0, 0, 0.8);
      border: 2px solid #0ff;
      z-index: 1;
      min-width: 150px;
    }

    .dropdown-content a {
      color: #0ff;
      padding: 10px;
      display: block;
      text-decoration: none;
      font-family: 'Press Start 2P', monospace;
      border-bottom: 1px solid #0ff;
    }

    .dropdown-content a:hover {
      background-color: #111;
      box-shadow: inset 0 0 0 2px #0ff;
    }

    .usuario-dropdown:hover .dropdown-content {
      display: block;
    }

    .usuario-icono {
      width: 32px;
      height: 32px;
      cursor: pointer;
      vertical-align: middle;
      border-radius: 50%;
      border: 2px solid #0ff;
    }

    .menu {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(0, 0, 0, 0.8);
      padding: 10px 20px;
    }
  </style>
</head>
<body>

  <!-- Menú superior -->
  <header class="menu">
    <a href="home.php">
      <img src="assets/fotos/logo.png" alt="Logo" class="logo">
    </a>

    <div class="usuario-dropdown">
      <span><?= htmlspecialchars($nombreUsuario) ?></span>
      <img src="<?= htmlspecialchars($fotoPerfil) ?>" alt="Perfil" class="usuario-icono" onclick="toggleDropdown()" id="iconoUsuario">
      <div class="dropdown-content" id="menuDesplegable">
        <a href="Home/dashboardUser.php">Mi cuenta</a>
        <a href="InicioSesion/CerrarSesion.php">Cerrar sesión</a>
      </div>
    </div>
  </header>

  <!-- Carrusel de fondo -->
  <div class="carousel">
    <div class="carousel-1">
      <div class="carousel-a"><img src="assets/fotos/fondo1.jpg" alt=""></div>
      <div class="carousel-a"><img src="assets/fotos/fondo2.jpg" alt=""></div>
      <div class="carousel-a"><img src="assets/fotos/fondo1.jpg" alt=""></div>
      <div class="carousel-a"><img src="assets/fotos/fondo2.jpg" alt=""></div>
    </div>
  </div>

  <!-- Carrusel de plataformas de emulación -->
  <div class="container-emulador">
    <div class="mySlides">
      <a href="n64/emuladorn64.php">
        <img src="assets/fotos/n64.png" alt="Nintendo 64">
      </a>
    </div>
    <div class="mySlides">
      <img src="assets/fotos/mame.png" alt="MAME">
    </div>
    <div class="mySlides">
      <a href="jsnes/emuladornes.php">
        <img src="assets/fotos/nes.png" alt="NES">
      </a>
    </div>

    <!-- Flechas -->
    <button class="flecha izquierda" onclick="plusSlides(-1)">&lt;</button>
    <button class="flecha derecha" onclick="plusSlides(1)">&gt;</button>

    <div class="elements">
      <span class="quadrate" onclick="currentSlide(1)"></span>
      <span class="quadrate" onclick="currentSlide(2)"></span>
      <span class="quadrate" onclick="currentSlide(3)"></span>
    </div>
  </div>

  <script src="assets/js/script.js"></script>
  <script>
    function toggleDropdown() {
      const menu = document.getElementById("menuDesplegable");
      menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }

    window.addEventListener('click', function(e) {
      const icon = document.getElementById("iconoUsuario");
      const menu = document.getElementById("menuDesplegable");
      if (!icon.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = "none";
      }
    });
  </script>
</body>
</html>
