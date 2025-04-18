<?php
require_once 'dbteams.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    
    $password = $_POST['password'];
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO t_usuarios (nombre_usuario, contrasena) VALUES (?, ?)";
    $stmt = $cone->prepare($sql);
    $stmt->bind_param("ss", $nombre_usuario, $passwordhash);

    if ($stmt->execute()) {
        echo "Usuario registrado correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
        header("Location: crear_usuario.html");
        exit();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>