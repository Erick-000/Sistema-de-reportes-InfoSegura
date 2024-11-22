<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../../config.php');

// Se capturan las valores a travez de el metodo post
$rol = $_POST['rol'];


// Consulta sql donde se pasan los valores capturados por el post para insertarlos en la base de datos
$sentencia = $pdo->prepare("INSERT INTO roles
( nombre_rol,fyh_creacion) 
VALUES (:nombre_rol, :fyh_creacion)");

// Se envian los paramentros de las variables capturadas por el metodo post
$sentencia->bindParam('nombre_rol', $rol);
$sentencia->bindParam('fyh_creacion', $fechaHora);

// Se ejecuta la sentencia
if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Rol creado con exito";
    $_SESSION['icono'] = "success";

    // Se redirige al usuario a la página de inicio de sesión.
    header('Location: '.$URL.'/roles/');

}else{
    // Se inicia una sesión y se guarda un mensaje de error en la variable de sesión 'mensaje' para que se pueda mostrar más adelante.
    session_start();
    $_SESSION['mensaje'] = "No se puedo registrar el rol";
    $_SESSION['icono'] = "error";

    // Se redirige al usuario a la página de inicio de sesión.
    header('Location: '.$URL.'/roles/create.php');
}
