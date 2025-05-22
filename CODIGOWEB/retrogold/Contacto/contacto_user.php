<?php
require_once '../Config/Connection.php';
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    echo "Debe iniciar sesión para enviar un mensaje.";
    exit;
}

$nombre = $_SESSION['username'];
$correo = $_POST['correo'] ?? '';
$mensaje = trim($_POST['mensaje']);

if (!$mensaje || !$correo) {
    echo "Todos los campos son obligatorios.";
    exit;
}

try {
    $sql = "INSERT INTO mensaje (nombre, email, mensaje, es_registrado) VALUES (:nombre, :correo, :mensaje, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'nombre' => $nombre,
        'correo' => $correo,
        'mensaje' => $mensaje
    ]);

    echo "Mensaje enviado correctamente.";
} catch (PDOException $e) {
    echo "Error al enviar el mensaje: " . $e->getMessage();
}
?>
