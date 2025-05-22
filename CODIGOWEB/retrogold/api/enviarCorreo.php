<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['correo']) || !isset($data['nombre']) || !isset($data['clave'])) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos']);
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'TU_CORREO@gmail.com';
    $mail->Password = 'TU_CONTRASEÑA_APLICACION';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('TU_CORREO@gmail.com', 'RetroGold Moder');
    $mail->addAddress($data['correo'], $data['nombre']);

    $mail->isHTML(true);
    $mail->Subject = 'Tu clave de administrador';
    $mail->Body = 'Hola ' . $data['nombre'] . ', tu clave es: <b>' . $data['clave'] . '</b>';

    $mail->send();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
}
?>
