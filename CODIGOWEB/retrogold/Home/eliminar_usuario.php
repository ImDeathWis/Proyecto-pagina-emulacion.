<?php
require_once '../Config/Connection.php';
$pdo = $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);

    if ($id > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);

            header("Location: dashboardAdmin.php");
            exit;
        } catch (PDOException $e) {
            echo "❌ Error al eliminar usuario: " . $e->getMessage();
        }
    } else {
        echo "❗ ID inválido.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
