<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once __DIR__ . '/../Config/Connection.php';
$pdo = $conn;

// Leer datos enviados por POST (form-urlencoded)
$id = isset($_POST['id']) ? intval($_POST['id']) : null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Falta el ID.']);
    exit;
}

try {
    // Marcar como aceptado (la clave se generará luego en generarClave.php)
    $stmt = $pdo->prepare("UPDATE solicitudes_admin SET estado = 'aceptado' WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Error al aceptar la solicitud.']);
}
?>
