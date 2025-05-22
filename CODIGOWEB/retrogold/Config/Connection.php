
<?php
$host = 'localhost';
$dbname = 'web_retrogold'; 
$username = 'root';    //retrogold
$password = '';    //RetroGold123*

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}
?>