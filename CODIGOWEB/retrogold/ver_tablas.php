<?php
// Conexión a MySQL
$conexion = new mysqli("localhost", "root", "", "web_retrogold");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Mostrar tablas existentes
$resultado = $conexion->query("SHOW TABLES");

if ($resultado->num_rows > 0) {
    echo "<h2>Tablas en la base de datos 'web_retrogold':</h2><ul>";
    while ($fila = $resultado->fetch_array()) {
        echo "<li>" . $fila[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No se encontraron tablas en la base de datos.";
}

$conexion->close();
?>
