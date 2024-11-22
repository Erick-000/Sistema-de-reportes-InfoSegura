<?php

$id_reporte_get = $_GET['id'];

// Se construye una consulata para mostrar a todos los usarios
$sql_reportes = "SELECT 
    r.id_reporte AS id_reporte,
    r.titulo AS titulo,
    r.descripcion AS descripcion,
    r.fyh_creacion AS fecha_creacion,
    r.imagen AS imagen,
    r.id_categoria AS id_categoria,
    c.nombre_categoria AS nombre_categoria,
    u.id_usuario AS id_usuario,
    u.nombre AS nombre_usuario,
    u.email AS email_usuario,
    rol.nombre_rol AS rol
FROM 
    reportes AS r
INNER JOIN 
    usuarios AS u ON r.id_usuario = u.id_usuario
INNER JOIN 
    roles AS rol ON u.id_rol = rol.id_rol
INNER JOIN
    categorias AS c ON r.id_categoria = c.id_categoria
WHERE
    id_reporte = '$id_reporte_get';
";

// Se prepara la consulta utilziando PDO
$query_reportes = $pdo->prepare($sql_reportes);
// Se ejecuta la consulta
$query_reportes->execute();

// Se obtienen los reultados de la consulta con un array asociativo
$reportes_datos = $query_reportes->fetchAll(PDO::FETCH_ASSOC);


foreach ($reportes_datos as $reportes_dato) {
    $titulo = $reportes_dato['titulo'];
    $descripcion = $reportes_dato['descripcion'];
    $nombre_categoria = $reportes_dato['nombre_categoria'];
    $id_usuario = $reportes_dato['id_usuario'];
    $fecha = $reportes_dato['fecha_creacion'];
    $email_usuario = $reportes_dato['email_usuario'];
    $imagen = $reportes_dato['imagen'];
}