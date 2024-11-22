<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../../config.php');

// Se capturan las valores a travez de el metodo post
$id_reporte = $_POST['id_reporte'];

// Consulta sql donde se pasan los valores capturados por el post para insertarlos en la base de datos
$sentencia = $pdo->prepare("DELETE FROM reportes WHERE id_reporte = :id_reporte");

// Se envian los paramentros de las variables capturadas por el metodo post
$sentencia->bindParam('id_reporte', $id_reporte);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Reporte eliminado con exito";
    $_SESSION['icono'] = "success";
    // Se redirige al usuario a la página de inicio de sesión.
    header('Location: ' . $URL . '/reportes/');
} else {
    // Se inicia una sesión y se guarda un mensaje de error en la variable de sesión 'mensaje' para que se pueda mostrar más adelante.
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar el reporte";
    $_SESSION['icono'] = "error";
    // Se redirige al usuario a la página de inicio de sesión.
    header('Location: ' . $URL . '/reportes/delete.php?id=' . $id_reporte);
}
