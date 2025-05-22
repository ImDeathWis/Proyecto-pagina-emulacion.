<?php
require_once '../Config/Connection.php';
$pdo = $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role_id'] ?? 'user';

    if ($username && $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (username, nombre, correo, contrasena, rol) VALUES (:username, :nombre, :correo, :contrasena, :rol)");
            $stmt->execute([
                ':username' => $username,
                ':nombre' => $username,
                ':correo' => $username . '@retrogold.com',
                ':contrasena' => $hash,
                ':rol' => $role
            ]);

            header("Location: dashboardAdmin.php");
            exit;
        } catch (PDOException $e) {
            echo "❌ Error al agregar usuario: " . $e->getMessage();
        }
    } else {
        echo "⚠️ Todos los campos son obligatorios.";
    }
} else {
    echo "Acceso denegado.";
}
?>
