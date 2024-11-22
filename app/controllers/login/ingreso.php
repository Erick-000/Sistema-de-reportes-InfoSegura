<?php
include('../../config.php');

$email = $_POST['email'];
$password_user = $_POST['password_user'];

$contador = 0;
// Modificamos la consulta para incluir el id_rol
$sql = "SELECT usuarios.*, roles.nombre_rol 
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_rol = roles.id_rol 
        WHERE email = :email";

$query = $pdo->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();

$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario) {
    $contador = $contador + 1;
    $email_tabla = $usuario['email'];
    $nombres_tabla = $usuario['nombre'];
    $password_user_tabla = $usuario['password_user'];
    $id_rol = $usuario['id_rol'];
}

if (($contador > 0) && (password_verify($password_user, $password_user_tabla))) {
    session_start();
    $_SESSION['sesion_email'] = $email;
    $_SESSION['nombre_usuario'] = $nombres_tabla;
    $_SESSION['id_rol'] = $id_rol;
    
    // Verificamos si es VISITANTE (id_rol = 3)
    if ($id_rol == 3) {
        header('Location: ' . $URL . '/principal.php');
    } else {
        // Otros roles van al index
        header('Location: ' . $URL . '/index.php');
    }
    exit();
    
} else {
    session_start();
    $_SESSION['mensaje'] = "Error datos incorrectos";
    header('Location: ' . $URL . '/login');
    exit();
}
?>