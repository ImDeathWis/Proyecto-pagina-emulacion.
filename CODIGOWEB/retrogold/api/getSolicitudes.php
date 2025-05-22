<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../Config/Connection.php';
$pdo = $conn;

try {
    $stmt = $pdo->prepare("SELECT id, nombre, correo, telefono, fecha, clave_generada FROM solicitudes_admin WHERE estado IN ('pendiente', 'aceptado')");
    $stmt->execute();
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $solicitudes]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Error al consultar solicitudes']);
}
?>
