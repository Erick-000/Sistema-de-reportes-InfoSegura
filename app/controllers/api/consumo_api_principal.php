<?php 
$url_base = "https://www.datos.gov.co/resource/ers2-kerr.json";

// Usar cURL para obtener los datos de la API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_base);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignorar errores SSL si existen

$response = curl_exec($ch);
if (curl_errno($ch)) {
    die("Error en cURL: " . curl_error($ch));
}
curl_close($ch);

// Decodificar los datos obtenidos
$datos_api = json_decode($response, true);

// Validar si se obtuvieron datos
if ($datos_api === null || empty($datos_api)) {
    $datos_api = []; // Asegurar que sea un arreglo vacío si no hay datos
}

// Ordenar los datos por fecha descendente
usort($datos_api, function ($a, $b) {
    $fecha_a = strtotime($a['fecha_creacion'] ?? '1970-01-01');
    $fecha_b = strtotime($b['fecha_creacion'] ?? '1970-01-01');
    return $fecha_b <=> $fecha_a;
});

// Paginación local
$reportes_por_pagina = 4; // Número de reportes por página
$pagina_actual_api = isset($_GET['pagina_api']) ? (int)$_GET['pagina_api'] : 1; // Página actual
$total_registros = count($datos_api); // Total de registros
$total_paginas_api = ceil($total_registros / $reportes_por_pagina); // Total de páginas

// Calcular el rango de datos a mostrar en la página actual
$inicio = ($pagina_actual_api - 1) * $reportes_por_pagina;
$datos_api_pagina = array_slice($datos_api, $inicio, $reportes_por_pagina);