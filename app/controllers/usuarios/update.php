<?php
include('../../config.php');

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];
$rol = $_POST['rol'];

if($password_user == ""){
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE usuarios
           SET nombre=:nombre,
           email=:email,
           id_rol = :id_rol, 
           fyh_actualizacion=:fyh_actualizacion
           WHERE id_usuario = :id_usuario");
    
        $sentencia->bindParam('nombre', $nombre);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('id_rol', $rol);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
    
         // Se ejecuta la sentencia
         $sentencia->execute();
         session_start();
         $_SESSION['mensaje'] = "Usuario actualizado con exito";
         $_SESSION['icono'] = "success";
         // Se redirige al usuario a la página de inicio de sesión.
         header('Location: ' . $URL . '/usuarios/');
    } else {
        // Se inicia una sesión y se guarda un mensaje de error en la variable de sesión 'mensaje' para que se pueda mostrar más adelante.
        session_start();
        $_SESSION['mensaje'] = "Las contraseñas deben ser iguales";
        $_SESSION['icono'] = "error";
        // Se redirige al usuario a la página de inicio de sesión.
        header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
    }
}else{
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE usuarios
           SET nombre=:nombre,
           email=:email, 
           id_rol = :id_rol,
           password_user=:password_user,
           fyh_actualizacion=:fyh_actualizacion
           WHERE id_usuario = :id_usuario");
    
        $sentencia->bindParam('nombre', $nombre);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('id_rol', $rol);
        $sentencia->bindParam('password_user', $password_user);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
    
        // Se ejecuta la sentencia
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Usuario actualizado con exito";
        $_SESSION['icono'] = "success";
        // Se redirige al usuario a la página de inicio de sesión.
        header('Location: ' . $URL . '/usuarios/');
    } else {
        // Se inicia una sesión y se guarda un mensaje de error en la variable de sesión 'mensaje' para que se pueda mostrar más adelante.
        session_start();
        $_SESSION['mensaje'] = "Las contraseñas deben ser iguales";
        $_SESSION['icono'] = "error";
        // Se redirige al usuario a la página de inicio de sesión.
        header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
    }
}


