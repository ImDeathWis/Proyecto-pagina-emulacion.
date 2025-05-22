<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Config/Connection.php';
$pdo = $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    if ($nombre && $correo && $contrasena) {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO solicitudes_admin (nombre, correo, telefono, clave_generada, estado, contrasena)
                                   VALUES (:nombre, :correo, :telefono, :clave, 'pendiente', :contrasena)");
            $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo,
                ':telefono' => $telefono,
                ':clave' => $clave,
                ':contrasena' => $contrasenaHash
            ]);
            echo "✅ Solicitud enviada correctamente.";
        } catch (PDOException $e) {
            echo "❌ Error al guardar la solicitud: " . $e->getMessage();
        }
    } else {
        echo "❗ Nombre, correo y contraseña son obligatorios.";
    }
} else {
    echo "Acceso no válido.";
}
?>
