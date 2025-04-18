<?php
require_once 'db_condominios.php';

if (isset($_POST['nombre_usuario']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = validate($_POST['nombre_usuario']);
    $password = validate($_POST['password']);

    if (empty($usuario)) {
        header("Location: index.php?error=El usuario es requerido");
        exit();
    } elseif (empty($password)) {
        header("Location: index.php?error=La contraseña es requerida");
        exit();
    } else {
        $sql = "SELECT * FROM t_usuarios WHERE nombre_usuario = '$usuario'";
        $result = mysqli_query($cone, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
             $passwordhash = $row["contrasena"];
             
           if ($row['nombre_usuario'] === $usuario && password_verify($password, $passwordhash)) {
                session_start();
                $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
                header("location:home.php");
                exit();
            } else {
                header("Location:index.php?error=El usuario o la contraseña son incorrectos");
                exit();
            }
        } else {
            header("Location:index.php?error=El usuario o la contraseña son incorrectos");
            exit();
        }
    }
} else {
    header("Location:index.php?error=El usuario o la contraseña son incorrectos");
    exit();
}
