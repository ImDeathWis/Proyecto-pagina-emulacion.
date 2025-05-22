<?php
require_once '../Config/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica que la conexión esté activa
    if (!isset($conn) || !$conn) {
        die("Error de conexión con la base de datos.");
    }

    // Recoger datos del formulario
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $clave = trim($_POST['clave'] ?? '');

    // Validación de campos obligatorios
    if (!$nombre || !$correo || !$clave) {
        echo "<script>alert('Todos los campos obligatorios deben completarse.'); window.location.href = '../registro/registerAdmin.html';</script>";
        exit;
    }

    try {
        // OPCIONAL: Verificar si la clave ya fue usada (si tienes la tabla claves_validas)
        $verificarClave = $conn->prepare("SELECT id FROM claves_validas WHERE clave = :clave AND usada = 0");
        $verificarClave->execute(['clave' => $clave]);
        if ($verificarClave->rowCount() === 0) {
            echo "<script>alert('La clave ingresada no es válida o ya fue utilizada.'); window.location.href = '../registro/registerAdmin.html';</script>";
            exit;
        }

        // Insertar solicitud
        $sql = "INSERT INTO solicitudes_admin (nombre, correo, telefono, clave_generada)
                VALUES (:nombre, :correo, :telefono, :clave)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'clave' => $clave
        ]);

        // Marcar la clave como usada (si aplica)
        $conn->prepare("UPDATE claves_validas SET usada = 1 WHERE clave = :clave")->execute(['clave' => $clave]);

        echo "<script>alert('Solicitud enviada correctamente. Un moderador la revisará.'); window.location.href = '../login/login.html';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error al registrar la solicitud: " . $e->getMessage() . "'); window.location.href = '../registro/registerAdmin.html';</script>";
    }
}
?>
