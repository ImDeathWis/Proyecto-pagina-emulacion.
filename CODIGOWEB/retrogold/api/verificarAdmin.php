<?php
require_once __DIR__ . '/../Config/Connection.php';
$pdo = $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $clave = $_POST['clave'] ?? '';

    if (!$correo || !$clave) {
        echo "❗ Debes completar ambos campos.";
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM solicitudes_admin WHERE correo = :correo AND clave_generada = :clave AND estado = 'aceptado'");
        $stmt->execute([':correo' => $correo, ':clave' => $clave]);
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($solicitud) {
            // Verificar si ya existe el usuario
            $check = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo");
            $check->execute([':correo' => $correo]);
            if ($check->rowCount() > 0) {
                echo "⚠️ Este correo ya está registrado como usuario.";
                exit;
            }

            // Usar username desde correo si no existe campo
            $username = explode('@', $solicitud['correo'])[0];

            // Insertar usuario
            $insert = $pdo->prepare("INSERT INTO usuarios (username, nombre, apellido, correo, telefono, contrasena, rol)
                                     VALUES (:username, :nombre, :apellido, :correo, :telefono, :contrasena, 'admin')");
            $insert->execute([
                ':username' => $username,
                ':nombre' => $solicitud['nombre'],
                ':apellido' => $solicitud['apellido'] ?? '',
                ':correo' => $solicitud['correo'],
                ':telefono' => $solicitud['telefono'],
                ':contrasena' => $solicitud['contrasena']
            ]);

            // Marcar solicitud como completada
            $update = $pdo->prepare("UPDATE solicitudes_admin SET estado = 'completado' WHERE id = :id");
            $update->execute([':id' => $solicitud['id']]);

            header("Location: ../login/login.html");
            exit;
        } else {
            echo "❌ Datos incorrectos o aún no has sido aceptado.";
        }
    } catch (PDOException $e) {
        echo "❌ Error de base de datos: " . $e->getMessage();
    }
} else {
    echo "Acceso no permitido.";
}
?>
