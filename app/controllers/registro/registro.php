<?php

include('../../config.php');

// Obtener los datos del formulario
$nombre_completo = $_POST['nombre_completo'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$confirm_password = $_POST['confirm_password'];

// ID del rol VISITANTE (asumiendo que es 3, ajusta según tu base de datos)
$id_rol_visitante = 3;

// Verificar que las contraseñas coincidan
if ($password_user !== $confirm_password) {
    session_start();
    $_SESSION['mensaje'] = "Error: Las contraseñas no coinciden.";
    header('Location: ' . $URL . '/registro.php');
    exit();
}

// Verificar si el email ya está registrado
$sql = "SELECT * FROM usuarios WHERE email = :email";
$query = $pdo->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();

$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

if (count($usuarios) > 0) {
    session_start();
    $_SESSION['mensaje'] = "Error: El correo ya está registrado.";
    header('Location: ' . $URL . '/registro.php');
    exit();
}

// Encriptar la contraseña
$password_hashed = password_hash($password_user, PASSWORD_BCRYPT);

try {
    // Iniciar transacción
    $pdo->beginTransaction();

    // Insertar el nuevo usuario en la base de datos incluyendo el id_rol
    $sql_insert = "INSERT INTO usuarios (nombre, email, password_user, id_rol, fyh_creacion) 
                   VALUES (:nombre, :email, :password_user, :id_rol, :fyh_creacion)";
    $query_insert = $pdo->prepare($sql_insert);

    $query_insert->bindParam(':nombre', $nombre_completo, PDO::PARAM_STR);
    $query_insert->bindParam(':email', $email, PDO::PARAM_STR);
    $query_insert->bindParam(':password', $password_hashed, PDO::PARAM_STR);
    $query_insert->bindParam(':id_rol', $id_rol_visitante, PDO::PARAM_INT);
    $query_insert->bindParam(':fyh_creacion', $fechaHora);

    $query_insert->execute();
    
    // Confirmar la transacción
    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Registro exitoso.";
    header('Location: ' . $URL . '/principal.php');
    
} catch (Exception $e) {
    // Si hay algún error, revertir la transacción
    $pdo->rollBack();
    
    session_start();
    $_SESSION['mensaje'] = "Error: No se pudo registrar el usuario.";
    header('Location: ' . $URL . '/registro.php');
}