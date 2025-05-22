<?php
session_start();
if (!isset($_SESSION['username'])) exit;

require_once '../Config/Connection.php';
$emulador = $_POST['emulador'] ?? '';
$usuario = $_SESSION['username'];

if ($emulador !== '') {
    $stmt = $conn->prepare("INSERT INTO estadisticas_emuladores (emulador, usuario) VALUES (?, ?)");
    $stmt->execute([$emulador, $usuario]);
}
?>
