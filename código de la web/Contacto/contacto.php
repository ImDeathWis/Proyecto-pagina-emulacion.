<?php
// Conexión con la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Por defecato en XAMP está vasío
$bd = "contacto_web";

$conexion = new mysqli ($host, $usuario, $contrasena, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre']; //campo nombre imput nombre
$email = $_POST['email'];   //campo email imput email
$mensaje = $_POST['mensaje'];   //campo mensaje imput mensaje

//Insertar en la base de dato
$sql = "INSERT INTO mensaje (nombre, email, mensaje) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $mensaje);

if ($stmt->execute()) {
    echo "Mensaje enviado correctomente.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
