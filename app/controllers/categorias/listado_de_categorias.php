<?php 

// Se construye una consulata para mostrar a todas las categorias
$sql_categorias = "SELECT * FROM categorias";
// Se prepara la consulta utilziando PDO
$query_categorias = $pdo->prepare($sql_categorias);
// Se ejecuta la consulta
$query_categorias->execute();

// Se obtienen los reultados de la consulta con un array asociativo
$categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);