<?php
    require_once '../Config/Connection.php';

    if ($_SERVER['REQUEST_METHOD']=== 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role_id = $_POST['role_id'];
        
        try {
            $connection = new Connection();
            $pdo = $connection->connect();



            $sql = "INSERT INTO usuarios(username, password, role_id) VALUES (:username, :password, :role_id)";
            $stmt = $pdo -> prepare($sql);
            $stmt->execute([
                'username' => $username,
                'password' => $password,
                'role_id' => $role_id,
            ]);

            echo "<script>
                    alert('Usuario registrado correctamente.');
                    window.location.href = '../login.html';
                </script>";

        } catch (\Throwable $th) {
            echo "<script>
                alert('Error al registrar el usuario: " . addslashes($th->getMessage()) . "');
                window.location.href = '../register.html';
            </script>";
        }
    }
