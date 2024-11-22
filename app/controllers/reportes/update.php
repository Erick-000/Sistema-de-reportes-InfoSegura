<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../../config.php');

// Se capturan las valores a travez de el metodo post
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$id_categoria = $_POST['categoria'];
$fecha = $_POST['fecha'];
$id_usuario = $_POST['id_usuario'];
$id_reporte = $_POST['id_reporte'];
$imagen_text = $_POST['imagen_text'];


        // Consulta sql donde se pasan los valores capturados por el post para insertarlos en la base de datos
        $sentencia = $pdo->prepare("UPDATE reportes 
SET  titulo = :titulo, 
     descripcion = :descripcion, 
     imagen = :imagen, 
     id_categoria = :id_categoria, 
     id_usuario = :id_usuario, 
    fyh_actualizacion = :fyh_actualizacion
WHERE id_reporte = :id_reporte");

    if($_FILES['imagen']['name'] != null ){
        $nombre_del_archivo = date(format:"Y-m-d-h-i-s");
    $imagen_text = $nombre_del_archivo. "___" .$_FILES['imagen']['name'];
    $location = "../../../reportes/img_reportes/".$imagen_text;
    move_uploaded_file($_FILES['imagen']['tmp_name'],$location);
    }else{
        
    }

        // Se envian los paramentros de las variables capturadas por el metodo post
        $sentencia->bindParam('titulo', $titulo);
        $sentencia->bindParam('descripcion', $descripcion);
        $sentencia->bindParam('imagen', $imagen_text);
        $sentencia->bindParam('id_categoria', $id_categoria);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_reporte', $id_reporte);

        // Se ejecuta la sentencia
        if($sentencia->execute()){
            
        session_start();
        $_SESSION['mensaje'] = "Reporte actualizado con exito";
        $_SESSION['icono'] = "success";
        // Se redirige al usuario a la página de inicio de sesión.
        header('Location: ' . $URL . '/reportes/');
    } else {
        // Se inicia una sesión y se guarda un mensaje de error en la variable de sesión 'mensaje' para que se pueda mostrar más adelante.
        session_start();
        $_SESSION['mensaje'] = "No se pudo actualizar el reporte";
        $_SESSION['icono'] = "error";
        // Se redirige al usuario a la página de inicio de sesión.
        header('Location: ' . $URL . '/reportes/update.php?id=' . $id_reporte);
    }