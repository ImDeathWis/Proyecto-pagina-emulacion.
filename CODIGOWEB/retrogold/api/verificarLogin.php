<?php
require_once __DIR__ . '/../Config/Connection.php';
$pdo = $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if ($correo && $contraseña) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM moderadores WHERE correo = :correo");
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $moderador = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($moderador && password_verify($contraseña, $moderador['contraseña'])) {
                echo "✅ Bienvenido, " . htmlspecialchars($moderador['nombre']);
            } else {
                echo "❌ Credenciales incorrectas.";
            }
        } catch (PDOException $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    } else {
        echo "❗ Completa todos los campos.";
    }
} else {
    echo "Acceso no válido.";
}
?>
