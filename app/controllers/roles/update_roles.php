<?php

$id_rol_get = $_GET['id'];

// Se construye una consulata para mostrar a todos los usarios
$sql_roles = "SELECT * FROM roles WHERE id_rol = '$id_rol_get'";
// Se prepara la consulta utilziando PDO
$query_roles = $pdo->prepare($sql_roles);
// Se ejecuta la consulta
$query_roles->execute();

// Se obtienen los reultados de la consulta con un array asociativo
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

foreach($roles_datos as $roles_dato){
    $rol = $roles_dato['nombre_rol'];
}