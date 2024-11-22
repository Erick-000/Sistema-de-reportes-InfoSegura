<?php

// Se construye una consulata para mostrar a todos los usarios
$sql_reportes = "SELECT 
    r.id_reporte AS id_reporte,
    r.titulo AS titulo,
    r.descripcion AS descripcion,
    r.fyh_creacion AS fecha_creacion,
    r.imagen AS imagen,
    u.id_usuario AS id_usuario,
    u.nombre AS nombre_usuario,
    u.email AS email_usuario,
    rol.nombre_rol AS rol,
    c.nombre_categoria AS nombre_categoria
FROM 
    reportes AS r
INNER JOIN 
    usuarios AS u ON r.id_usuario = u.id_usuario
INNER JOIN 
    roles AS rol ON u.id_rol = rol.id_rol
INNER JOIN
    categorias AS c ON r.id_categoria = c.id_categoria
";
// Se prepara la consulta utilziando PDO
$query_reportes = $pdo->prepare($sql_reportes);
// Se ejecuta la consulta
$query_reportes->execute();

// Se obtienen los reultados de la consulta con un array asociativo
$reportes_datos = $query_reportes->fetchAll(PDO::FETCH_ASSOC);
