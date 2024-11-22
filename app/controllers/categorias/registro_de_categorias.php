<?php

// Se incluye el archivo de configuración que contiene la conexión a la base de datos y otras variables globales.
include('../../config.php');

// Se captura el valor del nombre de la categoría a través del método GET.
$nombre_categoria = $_GET['nombre_categoria'];

// Consulta SQL para insertar un nuevo registro en la tabla 'tb_categorias' con los valores proporcionados.
$sentencia = $pdo->prepare("INSERT INTO categorias
    (nombre_categoria, fyh_creacion) 
    VALUES (:nombre_categoria, :fyh_creacion)");

// Se enlazan los parámetros de la consulta con las variables capturadas para evitar inyecciones SQL.
$sentencia->bindParam('nombre_categoria', $nombre_categoria);
$sentencia->bindParam('fyh_creacion', $fechaHora);

// Se ejecuta la sentencia SQL para insertar la categoría.
if ($sentencia->execute()) {
    // Si la ejecución es exitosa, se inicia una sesión y se almacena un mensaje de éxito.
    session_start();
    $_SESSION['mensaje'] = "Categoría creada con éxito";
    $_SESSION['icono'] = "success";

    // Se redirige al usuario a la página de categorías mediante una redirección en JavaScript.
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/categorias";
    </script>
    <?php
} else {
    // Si la inserción falla, se inicia una sesión y se almacena un mensaje de error.
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar la categoría";
    $_SESSION['icono'] = "error";

    // Se redirige al usuario a la página de categorías mediante una redirección en JavaScript.
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/categorias";
    </script>
    <?php
}
?>