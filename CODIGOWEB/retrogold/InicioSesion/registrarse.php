<?php 
require_once '../Config/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $nombre = trim($_POST['nombre']);
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : null;
    $correo = trim($_POST['correo']);
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : null;
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';

    // Validar campos obligatorios
    if (!$username || !$nombre || !$correo || !$password || !$confirm_password) {
        echo "<script>alert('Todos los campos marcados son obligatorios.'); window.location.href = '../registro/register.html';</script>";
        exit;
    }

    // Validar contraseñas
    if ($password !== $confirm_password) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.location.href = '../registro/register.html';</script>";
        exit;
    }

    // Hashear contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Verificar si usuario o correo ya existen
        $sqlCheck = "SELECT id FROM usuarios WHERE username = :username OR correo = :correo";
        $stmt = $conn->prepare($sqlCheck);
        $stmt->execute(['username' => $username, 'correo' => $correo]);

        if ($stmt->fetch()) {
            echo "<script>alert('El usuario o correo ya existe.'); window.location.href = '../registro/register.html';</script>";
            exit;
        }

        // Insertar nuevo usuario
        $sql = "INSERT INTO usuarios (username, nombre, apellido, correo, telefono, contrasena, rol) 
                VALUES (:username, :nombre, :apellido, :correo, :telefono, :contrasena, :rol)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'nombre' => $nombre,
            'apellido' => $apellido ?: null,
            'correo' => $correo,
            'telefono' => $telefono ?: null,
            'contrasena' => $hashed_password,
            'rol' => $rol
        ]);

        echo "<script>alert('Registro exitoso.'); window.location.href = '../login/login.html';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href = '../registro/register.html';</script>";
    }
}
?>
