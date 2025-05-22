<?php
session_start();

// Verifica que el usuario esté autenticado y sea del rol 'user'
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'user') {
    header('Location: ../login/login.html');
    exit;
}

$username = $_SESSION['username']; // se usa para los nombres de archivo

// Crea carpetas si no existen
$directorio_perfil = "../uploads/perfiles/";
$directorio_fondo  = "../uploads/fondos/";

if (!file_exists($directorio_perfil)) {
    mkdir($directorio_perfil, 0775, true);
}
if (!file_exists($directorio_fondo)) {
    mkdir($directorio_fondo, 0775, true);
}

// Procesar subida de foto de perfil
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array(strtolower($extension), $permitidas)) {
        $nombreFoto = $directorio_perfil . $username . '.png';
        move_uploaded_file($_FILES['foto']['tmp_name'], $nombreFoto);
    }
}

// Procesar subida de fondo personalizado
if (isset($_FILES['fondo']) && $_FILES['fondo']['error'] === 0) {
    $extension = pathinfo($_FILES['fondo']['name'], PATHINFO_EXTENSION);
    $permitidas = ['jpg', 'jpeg', 'png'];
    if (in_array(strtolower($extension), $permitidas)) {
        $nombreFondo = $directorio_fondo . $username . '.jpg';
        move_uploaded_file($_FILES['fondo']['tmp_name'], $nombreFondo);
    }
}

// Redirigir al dashboard
header('Location: dashboardUser.php');
exit;
