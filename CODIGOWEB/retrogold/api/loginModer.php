<?php
session_start();

$correo = $_POST['correo'] ?? '';
$clave = $_POST['clave'] ?? '';

$moderadores = [
    'mateo@retrogold.com' => 'RetroGold123*',
    'luismiguel@retrogold.com' => 'Arcade4Life!'
];

if (isset($moderadores[$correo]) && $moderadores[$correo] === $clave) {
    $_SESSION['moder_correo'] = $correo;
    $_SESSION['moder_nombre'] = explode('@', $correo)[0]; // solo el nombre antes del @
    header("Location: panel.php");
    exit;
} else {
    echo "❌ Acceso denegado. Verifica tus credenciales.";
}
?>
