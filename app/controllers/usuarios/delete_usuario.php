<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../../config.php');

// Se capturan las valores a travez de el metodo post
$id_usuario = $_POST['id_usuario'];

// Consulta sql donde se pasan los valores capturados por el post para insertarlos en la base de datos
$sentencia = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");


// Se envian los paramentros de las variables capturadas por el metodo post
$sentencia->bindParam('id_usuario', $id_usuario);

// Se ejecuta la sentencia
$sentencia->execute();
session_start();
$_SESSION['mensaje'] = "Usuario eliminado con exito";
$_SESSION['icono'] = "success";
// Se redirige al usuario a la página de inicio de sesión.
header('Location: ' . $URL . '/usuarios/');