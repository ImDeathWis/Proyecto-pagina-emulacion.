<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: ../login.html');
    exit;
}

// Verifica el rol del usuario
if ($_SESSION['role_id'] !== 1) {
    echo "Acceso denegado. Solo los administradores pueden acceder a esta página.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/styles-home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="../home2.html">Inicio</a>
        <a href="../stats.html">Estadísticas</a>
        <a href="../informe.html">Informes</a>
        <a href="../InicioSesion/CerrarSesion.php">Cerrar sesión</a>
    </div>
    <div class="main">
        <h1>Bienvenido al Dashboard</h1>
        <div class="card">
            <h3>Resumen de Actividades</h3>
            <p>Aquí puedes ver un resumen de tus actividades recientes.</p>
        </div>
        <div class="card">
            <h3>Estadísticas Recientes</h3>
            <p>Visualiza las estadísticas más recientes aquí.</p>
        </div>
        <div class="card">
            <h3>Informes Generales</h3>
            <p>Consulta los informes generales de tu sistema.</p>
        </div>
    </div>
</body>
</html>
