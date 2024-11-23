<?php
// URL de la nueva API para obtener los datos
$url = "https://www.datos.gov.co/resource/ers2-kerr.json";

// Usar cURL para obtener los datos
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignorar errores SSL si existen

$response = curl_exec($ch);

// Verificar si ocurrió un error en la ejecución de cURL
if (curl_errno($ch)) {
    die("Error en cURL: " . curl_error($ch));
}

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Validar el código de respuesta HTTP
if ($http_code !== 200) {
    die("Error: El servidor respondió con un código HTTP $http_code.");
}

// Decodificar el JSON
$datos_api = json_decode($response, true);

// Validar si la respuesta contiene datos
if ($datos_api === null || empty($datos_api)) {
    $datos_api = []; // Aseguramos que $datos_api sea un arreglo vacío si no hay datos
}