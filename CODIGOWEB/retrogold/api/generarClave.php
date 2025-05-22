<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once __DIR__ . '/../Config/Connection.php';
$pdo = $conn;

function generarClaveUnica($longitud = 10) {
    return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $longitud);
}

$id = isset($_POST['id']) ? intval($_POST['id']) : null;

if (!$id) {
    echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
    exit;
}

$clave = generarClaveUnica();

try {
    $stmt = $pdo->prepare("UPDATE solicitudes_admin SET clave_generada = :clave WHERE id = :id");
    $stmt->bindParam(':clave', $clave);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo json_encode(['success' => true, 'clave' => $clave]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Error al guardar la clave']);
}
?>
