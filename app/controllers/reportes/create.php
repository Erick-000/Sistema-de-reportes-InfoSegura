<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../../config.php');

// Se capturan las valores a travez de el metodo post
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$fecha = $_POST['fecha'];
$id_usuario = $_POST['id_usuario'];
$imagen = $_POST['imagen'];

$nombre_del_archivo = date(format:"Y-m-d-h-i-s");
$filename = $nombre_del_archivo. "___" .$_FILES['imagen']['name'];
$location = "../../../reportes/img_reportes/".$filename;
move_uploaded_file($_FILES['imagen']['tmp_name'],$location);

// Consulta sql donde se pasan los valores capturados por el post para insertarlos en la base de datos
$sentencia = $pdo->prepare("INSERT INTO reportes
( titulo,descripcion,imagen,id_categoria,id_usuario,fyh_creacion) 
VALUES (:titulo,:descripcion,:imagen,:id_categoria,:id_usuario,:fyh_creacion)");

// Se envian los paramentros de las variables capturadas por el metodo post
$sentencia->bindParam('titulo', $titulo);
$sentencia->bindParam('descripcion', $descripcion);
$sentencia->bindParam('imagen', $filename);
$sentencia->bindParam('id_categoria', $categoria);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_creacion', $fechaHora);

// Se ejecuta la sentencia
if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Reporte creado con exito";
    $_SESSION['icono'] = "success";

    // Se redirige al usuario a la página de inicio de sesión.
    header('Location: '.$URL.'/reportes/');

}else{
    // Se inicia una sesión y se guarda un mensaje de error en la variable de sesión 'mensaje' para que se pueda mostrar más adelante.
    session_start();
    $_SESSION['mensaje'] = "No se puedo registrar el reporte";
    $_SESSION['icono'] = "error";

    // Se redirige al usuario a la página de inicio de sesión.
    header('Location: '.$URL.'/reportes/create.php');
}
