<?php
require_once '../Config/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (!$nombre || !$email || !$mensaje) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    try {
        $sql = "INSERT INTO mensaje (nombre, email, mensaje, es_registrado) 
                VALUES (:nombre, :email, :mensaje, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'email' => $email,
            'mensaje' => $mensaje
        ]);

        echo "Mensaje enviado correctamente.";
    } catch (PDOException $e) {
        echo "Error al enviar el mensaje: " . $e->getMessage();
    }
}
?>
