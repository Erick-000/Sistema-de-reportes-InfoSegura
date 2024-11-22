<?php

session_start();
if (isset($_SESSION['sesion_email'])) {
  $email_sesion = $_SESSION['sesion_email'];
  $sql = "SELECT us.id_usuario as id_usuario, us.nombre as nombre, us.email 
as email, nombre_rol.nombre_rol as rol FROM usuarios as us INNER JOIN roles 
as nombre_rol ON us.id_rol = nombre_rol.id_rol WHERE email = '$email_sesion'";
  $query = $pdo->prepare($sql);

  $query->execute();

  $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
  foreach ($usuarios as $usuario) {
    $id_usuario_sesion = $usuario['id_usuario'];
    $nombres_sesion = $usuario['nombre'];
    $rol_sesion = $usuario['rol'];
  }
} else {
  echo "No existe sesión";
  header('Location: ' . $URL . '/login');
}