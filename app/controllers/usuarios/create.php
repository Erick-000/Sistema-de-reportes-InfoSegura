<?php
include('../../config.php');

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];

if ($password_user == $password_repeat) {
    // Comprobar si el email ya existe
    $consulta = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
    $consulta->bindParam(':email', $email);
    $consulta->execute();
    $existe = $consulta->fetchColumn();

    if ($existe > 0) {
        // Si el email ya existe, mostrar un mensaje de error y redirigir
        session_start();
        $_SESSION['mensaje'] = "El correo ya está registrado. Intenta con otro.";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/usuarios/create.php');
        exit;
    }

    // Hash de la contraseña y creación del usuario
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("INSERT INTO usuarios
       (nombre, email, id_rol, password_user, fyh_creacion)
       VALUES (:nombre, :email, :id_rol, :password_user, :fyh_creacion)");

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':id_rol', $rol);
    $sentencia->bindParam(':password_user', $password_user);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "Usuario registrado con éxito";
    $_SESSION['icono'] = "success";

    header('Location: '.$URL.'/usuarios/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Las contraseñas deben ser iguales";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/usuarios/create.php');
}
