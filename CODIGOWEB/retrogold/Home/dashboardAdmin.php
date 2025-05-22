<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login/login.html");
    exit();
}

require_once '../Config/Connection.php';
$pdo = $conn;
$username = $_SESSION['username'];

// Usuarios normales con más información
$sqlUsuarios = "SELECT id, username, correo, fecha_registro FROM usuarios WHERE rol = 'user'";
$stmtUsuarios = $pdo->query($sqlUsuarios);
$users = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

// Mensajes
$sqlMensajes = "SELECT emisor, receptor, contenido, fecha FROM mensaje ORDER BY fecha DESC";
$stmtMensajes = $pdo->query($sqlMensajes);
$mensajes = $stmtMensajes->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <link rel="stylesheet" href="../assets/css/styles-home.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #ffffff;
      color: #2c3e50;
    }
    .sidebar {
      width: 220px;
      background-color: #1f2937;
      height: 100vh;
      position: fixed;
      padding: 20px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }
    .sidebar h2 {
      color: #fff;
      margin-bottom: 30px;
    }
    .sidebar button,
    .sidebar a {
      display: block;
      margin-bottom: 12px;
      background: none;
      color: #d1d5db;
      border: none;
      text-align: left;
      width: 100%;
      padding: 10px;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .sidebar button:hover,
    .sidebar a:hover {
      color: #fff;
      background-color: #374151;
    }
    .main {
      margin-left: 240px;
      padding: 40px;
    }
    .content-section { display: none; }
    .active-section { display: block; }
    h1, h2, h3 { color: #111827; }
    .campo-edit {
      margin-bottom: 20px;
    }
    .campo-edit input {
      width: 100%;
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      background-color: #f9fafb;
      color: #111827;
    }
    .submit-link, .submit-button {
      display: inline-block;
      padding: 10px 24px;
      background-color: #111827;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      transition: background-color 0.3s ease;
      border: none;
      cursor: pointer;
    }
    .submit-link:hover, .submit-button:hover {
      background-color: #1f2937;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table th, table td {
      padding: 12px;
      border: 1px solid #e5e7eb;
      text-align: center;
      background-color: #f9fafb;
      color: #000;
    }
    table th {
      background-color: #111827;
      color: #fff;
    }
  </style>
  <script>
    function mostrarSeccion(id) {
      document.querySelectorAll('.content-section').forEach(div => {
        div.classList.remove('active-section');
      });
      document.getElementById(id).classList.add('active-section');
    }
    window.onload = () => mostrarSeccion('inicio');
  </script>
</head>
<body>
  <div class="sidebar">
    <h2>Administrador</h2>
    <button onclick="mostrarSeccion('inicio')">Inicio</button>
    <button onclick="mostrarSeccion('perfil')">Mi Perfil</button>
    <button onclick="mostrarSeccion('usuarios')">Usuarios</button>
    <button onclick="mostrarSeccion('mensajes')">Mensajes</button>
    <button onclick="mostrarSeccion('agregar_usuario')">Registrar Usuario</button>
    <a href="../InicioSesion/CerrarSesion.php">Cerrar sesión</a>
  </div>

  <div class="main">
    <div id="inicio" class="content-section active-section">
      <h1>Bienvenido, <?= htmlspecialchars($username) ?></h1>
      <p>Panel principal donde puedes visualizar estadísticas globales y el estado de actividad del sistema.</p>
      <div style="display: flex; gap: 40px; margin-top: 40px;">
        <div style="flex: 1; background: #f1f5f9; padding: 20px; border-radius: 8px;">
          <h3 style="color:#000">Usuarios registrados esta semana</h3>
          <canvas id="graficoUsuarios"></canvas>
        </div>
        <div style="flex: 1; background: #f1f5f9; padding: 20px; border-radius: 8px;">
          <h3 style="color:#000">Actividad por emulador (clics)</h3>
          <canvas id="graficoActividad"></canvas>
        </div>
      </div>
    </div>

    <div id="perfil" class="content-section">
      <h2>Mi Perfil</h2>
      <p>Desde aquí puedes gestionar tu configuración de administrador y personalización del panel.</p>
      <form method="POST" enctype="multipart/form-data">
        <div class="campo-edit">
          <label>Foto de perfil:</label>
          <input type="file" name="foto">
        </div>
        <div class="campo-edit">
          <label>Fondo del panel:</label>
          <input type="file" name="fondo">
        </div>
        <div class="campo-edit">
          <button class="submit-button">Guardar cambios</button>
        </div>
      </form>
    </div>

    <div id="usuarios" class="content-section">
      <h2>Usuarios Registrados</h2>
      <p>Visualiza todos los usuarios registrados, sus correos y fechas de registro.</p>
      <table>
        <thead>
          <tr><th>ID</th><th>Usuario</th><th>Correo</th><th>Fecha de Registro</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['correo']) ?></td>
            <td><?= htmlspecialchars($u['fecha_registro']) ?></td>
            <td>
              <form method="POST" action="../Home/eliminar_usuario.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                <button class="submit-button" onclick="return confirm('Eliminar este usuario?')">Eliminar</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div id="mensajes" class="content-section">
      <h2>Mensajes</h2>
      <p>Consulta los mensajes enviados por los usuarios.</p>
      <table>
        <thead>
          <tr><th>Emisor</th><th>Receptor</th><th>Contenido</th><th>Fecha</th></tr>
        </thead>
        <tbody>
          <?php foreach ($mensajes as $msg): ?>
          <tr>
            <td><?= htmlspecialchars($msg['emisor']) ?></td>
            <td><?= htmlspecialchars($msg['receptor']) ?></td>
            <td><?= nl2br(htmlspecialchars($msg['contenido'])) ?></td>
            <td><?= $msg['fecha'] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div id="agregar_usuario" class="content-section">
      <h2>Registrar Nuevo Usuario</h2>
      <p>Completa los siguientes campos para añadir un nuevo usuario al sistema.</p>
      <form action="../Home/agregar_usuario.php" method="POST">
        <div class="campo-edit">
          <label for="username">Usuario*</label>
          <input type="text" name="username" id="username" required>
        </div>
        <div style="display: flex; gap: 20px;">
          <div class="campo-edit" style="flex: 1;">
            <label for="nombre">Nombre*</label>
            <input type="text" name="nombre" id="nombre" required>
          </div>
          <div class="campo-edit" style="flex: 1;">
            <label for="apellido">Apellido*</label>
            <input type="text" name="apellido" id="apellido" required>
          </div>
        </div>
        <div class="campo-edit">
          <label for="correo">Correo Gmail*</label>
          <input type="email" name="correo" id="correo" required>
        </div>
        <div class="campo-edit">
          <label for="telefono">Teléfono (opcional)</label>
          <input type="tel" name="telefono" id="telefono" pattern="[0-9]{9}">
        </div>
        <div style="display: flex; gap: 20px;">
          <div class="campo-edit" style="flex: 1;">
            <label for="password">Contraseña*</label>
            <input type="password" name="password" id="password" required>
          </div>
          <div class="campo-edit" style="flex: 1;">
            <label for="confirmar">Confirmar contraseña*</label>
            <input type="password" name="confirmar" id="confirmar" required>
          </div>
        </div>
        <input type="hidden" name="rol" value="user">
        <div class="campo-edit" style="text-align: center;">
          <button type="submit" class="submit-button">Registrar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const ctxUsuarios = document.getElementById('graficoUsuarios').getContext('2d');
    new Chart(ctxUsuarios, {
      type: 'line',
      data: {
        labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
        datasets: [{
          label: 'Usuarios nuevos',
          data: [2, 5, 3, 6, 4, 7, 1],
          borderColor: '#3b82f6',
          backgroundColor: 'rgba(59, 130, 246, 0.2)',
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });

    const ctxActividad = document.getElementById('graficoActividad').getContext('2d');
    new Chart(ctxActividad, {
      type: 'doughnut',
      data: {
        labels: ['NES', 'N64'],
        datasets: [{
          label: 'Clics por emulador',
          data: [10, 25],
          backgroundColor: ['#f87171', '#34d399'],
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          legend: {
            position: 'bottom',
            labels: { color: '#111' }
          }
        }
      }
    });
  </script>
</body>
</html>
