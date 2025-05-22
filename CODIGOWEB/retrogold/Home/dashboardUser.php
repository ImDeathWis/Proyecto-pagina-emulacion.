<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'user') {
    header('Location: ../login/login.html');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$email = htmlspecialchars($_SESSION['email'] ?? 'usuario@ejemplo.com');

$fondoPath = "../uploads/fondos/$username.jpg";
$fondoStyle = file_exists($fondoPath) ? "background-image: url('$fondoPath'); background-size: cover;" : "background: radial-gradient(circle, #000000 0%, #0a0a0a 100%);";
$perfilPath = "../uploads/perfiles/$username.png";
$fotoPerfil = file_exists($perfilPath) ? $perfilPath : '../assets/fotos/default-user.png';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Usuario</title>
  <link rel="stylesheet" href="../assets/css/styles-home.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap">
  <style>
    body {
      margin: 0;
      font-family: 'Press Start 2P', cursive;
      color: #00ffe1;
    }

    .sidebar {
      width: 240px;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.8);
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      gap: 20px;
      border-right: 2px solid #00ffe1;
    }

    .sidebar h2 {
      font-size: 16px;
      color: #ffccff;
      text-align: center;
    }

    .sidebar button,
    .sidebar a {
      background: none;
      border: 2px solid #00ffe1;
      color: #00ffe1;
      font-size: 10px;
      padding: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
      text-decoration: none;
    }

    .sidebar button:hover,
    .sidebar a:hover {
      background: #00ffe1;
      color: black;
    }

    .main {
      margin-left: 260px;
      padding: 40px;
    }

    .content-section {
      display: none;
    }

    .active-section {
      display: block;
    }

    .foto-perfil {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-size: cover;
      background-position: center;
      margin: 0 auto 20px;
      border: 3px solid #00ffe1;
    }

    .campo-edit {
      margin: 20px 0;
    }

    .campo-edit input[type="text"],
    .campo-edit input[type="email"],
    .campo-edit textarea {
      width: 100%;
      padding: 12px;
      font-family: 'Press Start 2P', cursive;
      background: black;
      color: #00ffe1;
      border: 2px solid #00ffe1;
      border-radius: 8px;
    }

    .input-btn {
      display: inline-block;
      padding: 12px 24px;
      background-color: black;
      color: #00ffe1;
      border: 2px solid #00ffe1;
      font-family: 'Press Start 2P', cursive;
      text-decoration: none;
      transition: all 0.3s ease;
      margin-top: 10px;
      text-align: center;
    }

    .input-btn:hover {
      background-color: #00ffe1;
      color: black;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border: 2px solid #00ffe1;
    }

    table th, table td {
      border: 1px solid #00ffe1;
      padding: 12px;
      text-align: center;
    }

    table th {
      background: #111;
      color: #00ffe1;
    }

    table td {
      background: #000;
    }
  </style>
  <script>
    function mostrarSeccion(id) {
      document.querySelectorAll('.content-section').forEach(div => {
        div.classList.remove('active-section');
      });
      document.getElementById(id).classList.add('active-section');
    }

    window.onload = () => {
      mostrarSeccion('inicio');
    }
  </script>
</head>
<body style="<?= $fondoStyle ?>">

  <!-- Sidebar -->
  <div class="sidebar">
    <h2><?= $username ?></h2>
    <button onclick="mostrarSeccion('inicio')">Inicio</button>
    <button onclick="mostrarSeccion('perfil')">Mi Perfil</button>
    <button onclick="mostrarSeccion('estadisticas')">Estadísticas</button>
    <button onclick="mostrarSeccion('contacto')">Contacto</button>
    <a href="../InicioSesion/CerrarSesion.php">Cerrar sesión</a>
  </div>

  <!-- Contenido principal -->
  <div class="main">

    <!-- Sección Inicio -->
    <div id="inicio" class="content-section active-section">
      <h1>Inicio</h1>
      <p>Desde aquí puedes volver a jugar, explorar y disfrutar.</p>
      <a href="../home.php" class="input-btn">Ir a los juegos</a>
    </div>

    <!-- Sección Perfil -->
    <div id="perfil" class="content-section">
      <h2>Mi Perfil</h2>
      <div class="foto-perfil" style="background-image: url('<?= $fotoPerfil ?>');"></div>
      <form action="guardar_configuracion.php" method="POST" enctype="multipart/form-data">
        <div class="campo-edit">
          <label for="foto">Cambiar foto de perfil:</label><br>
          <input type="file" name="foto" id="foto" accept="image/*">
        </div>
        <div class="campo-edit">
          <label for="fondo">Cambiar fondo del dashboard:</label><br>
          <input type="file" name="fondo" id="fondo" accept="image/*">
        </div>
        <input type="submit" class="input-btn" value="Guardar cambios">
      </form>
    </div>

    <!-- Sección Estadísticas -->
    <div id="estadisticas" class="content-section">
      <h2>Estadísticas</h2>
      <table>
        <tr><th>Juego</th><th>Puntuación</th><th>Último acceso</th></tr>
        <tr><td>NES</td><td>1200</td><td>2024-05-10</td></tr>
        <tr><td>MAME</td><td>950</td><td>2024-05-09</td></tr>
      </table>
    </div>

    <!-- Sección Contacto -->
    <div id="contacto" class="content-section">
      <h2>Contacto con Administrador</h2>
      <form action="../Home/contacto_user.php" method="POST">
        <div class="campo-edit">
          <label>Nombre:</label><br>
          <input type="text" name="nombre" value="<?= $username ?>" required>
        </div>
        <div class="campo-edit">
          <label>Correo:</label><br>
          <input type="email" name="email" value="<?= $email ?>" required>
        </div>
        <div class="campo-edit">
          <label>Mensaje:</label><br>
          <textarea name="mensaje" rows="5" required></textarea>
        </div>
        <input type="submit" class="input-btn" value="Enviar Mensaje">
      </form>
    </div>

  </div>

</body>
</html>
