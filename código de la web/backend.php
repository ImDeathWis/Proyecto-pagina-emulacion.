<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);

    // Aquí puedes conectar a MySQL, guardar datos, o enviar correos
    echo "¡Hola $nombre! Tu correo ($email) ha sido registrado.";
}
?>
