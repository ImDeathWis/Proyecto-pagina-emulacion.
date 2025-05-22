<?php
session_start();
require_once '../Config/Connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = trim($_POST["username"] ?? '');
    $contrasena = $_POST["password"] ?? '';

    if (!$input || !$contrasena) {
        echo "<script>alert('Completa todos los campos.'); window.location.href = '../login/login.html';</script>";
        exit;
    }

    $sql = "SELECT * FROM usuarios WHERE correo = :input OR username = :input LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':input', $input);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($contrasena, $usuario["contrasena"])) {
            $_SESSION["usuario"] = $usuario["correo"];
            $_SESSION["rol"] = $usuario["rol"];
            $_SESSION["username"] = $usuario["username"];
            $_SESSION["nombre"] = $usuario["nombre"];

            if ($usuario["rol"] === "admin") {
                header("Location: ../Home/dashboardAdmin.php");
            } else {
                header("Location: ../Home/dashboardUser.php");
            }
            exit;
        } else {
            echo "<script>alert('❌ Contraseña incorrecta.'); window.location.href = '../login/login.html';</script>";
        }
    } else {
        echo "<script>alert('❌ Usuario no encontrado.'); window.location.href = '../login/login.html';</script>";
    }
} else {
    echo "Acceso no permitido.";
}
?>
