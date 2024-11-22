<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales, como la conexión a la base de datos.
include('../../config.php');

// Se capturan los valores enviados a través del método GET (posiblemente desde una solicitud asíncrona o URL).
$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];

// Consulta SQL para actualizar una fila de la tabla 'tb_categorias' con los valores capturados.
$sentencia = $pdo->prepare("UPDATE categorias
    SET nombre_categoria = :nombre_categoria, 
        fyh_actualizacion = :fyh_actualizacion
    WHERE id_categoria = :id_categoria");

// Se vinculan los parámetros con los valores capturados para evitar inyecciones SQL y proporcionar valores seguros a la consulta.
$sentencia->bindParam('nombre_categoria', $nombre_categoria);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_categoria', $id_categoria);

// Se ejecuta la consulta para actualizar los datos.
if ($sentencia->execute()) {
    // Si la ejecución es exitosa, se inicia una sesión para almacenar mensajes de éxito.
    session_start();
    $_SESSION['mensaje'] = "Categoria actualizada con éxito";
    $_SESSION['icono'] = "success";
    // Se redirige al usuario a la página de categorías.
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/categorias";
    </script>
    <?php
} else {
    // Si la ejecución falla, se inicia una sesión y se almacena un mensaje de error.
    session_start();
    $_SESSION['mensaje'] = "No se pudo actualizar la categoría";
    $_SESSION['icono'] = "error";
    // Se redirige al usuario a la página de categorías.
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/categorias";
    </script>
    <?php
}
?>