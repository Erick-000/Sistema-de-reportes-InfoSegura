<?php
class APICache {
    private $cache_file;
    private $cache_duration;

    public function __construct($cache_file = 'api_cache.json', $duration = 3600) {
        // Asegurarse de que el directorio cache existe
        $cache_dir = dirname(__FILE__) . '/cache';
        if (!file_exists($cache_dir)) {
            mkdir($cache_dir, 0777, true);
        }
        $this->cache_file = $cache_dir . '/' . $cache_file;
        $this->cache_duration = $duration;
    }

    public function get() {
        if (file_exists($this->cache_file)) {
            $cache_data = json_decode(file_get_contents($this->cache_file), true);
            if ($cache_data && 
                isset($cache_data['timestamp']) && 
                (time() - $cache_data['timestamp']) < $this->cache_duration) {
                return $cache_data['data'];
            }
        }
        return null;
    }

    public function set($data) {
        $cache_data = [
            'timestamp' => time(),
            'data' => $data
        ];
        file_put_contents($this->cache_file, json_encode($cache_data));
    }
}

class APIConsumer {
    private $base_url;
    private $cache;
    private $total_count = null;

    public function __construct($base_url) {
        $this->base_url = $base_url;
        $this->cache = new APICache();
    }

    public function getTotalCount() {
        if ($this->total_count === null) {
            try {
                $url = $this->base_url . '?$select=count(*)';
                $ch = curl_init();
                curl_setopt_array($ch, [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_TIMEOUT => 5
                ]);

                $response = curl_exec($ch);
                curl_close($ch);

                $count_data = json_decode($response, true);
                if (isset($count_data[0]['count'])) {
                    $this->total_count = (int)$count_data[0]['count'];
                } else {
                    $this->total_count = 0;
                }
            } catch (Exception $e) {
                error_log("Error obteniendo conteo: " . $e->getMessage());
                $this->total_count = 0;
            }
        }
        return $this->total_count;
    }

    public function fetchData($page = 1, $per_page = 4) {
        // Intentar obtener datos del caché
        $cached_data = $this->cache->get();
        if ($cached_data !== null) {
            // Si tenemos datos en caché, los paginamos localmente
            $total = count($cached_data);
            $offset = ($page - 1) * $per_page;
            return [
                'data' => array_slice($cached_data, $offset, $per_page),
                'total' => $total,
                'current_page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($total / $per_page)
            ];
        }

        // Si no hay caché, obtenemos de la API
        try {
            $offset = ($page - 1) * $per_page;
            $url = $this->base_url . "?" . 
                   "$" . "limit=1000"; // Obtenemos más registros para cachear

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_TIMEOUT => 5
            ]);

            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                throw new Exception("Error en cURL: " . curl_error($ch));
            }

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($http_code !== 200) {
                throw new Exception("Error en la API: HTTP {$http_code}");
            }

            $all_data = json_decode($response, true);
            if (!$all_data) {
                throw new Exception("Error decodificando JSON");
            }

            // Ordenar los datos por fecha
            usort($all_data, function ($a, $b) {
                $fecha_a = strtotime($a['fecha_del_hecho'] ?? '1970-01-01');
                $fecha_b = strtotime($b['fecha_del_hecho'] ?? '1970-01-01');
                return $fecha_b <=> $fecha_a;
            });

            // Guardar en caché
            $this->cache->set($all_data);

            // Paginar los datos
            $total = count($all_data);
            $paginated_data = array_slice($all_data, $offset, $per_page);

            return [
                'data' => $paginated_data,
                'total' => $total,
                'current_page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($total / $per_page)
            ];

        } catch (Exception $e) {
            error_log("Error consumiendo API: " . $e->getMessage());
            return [
                'data' => [],
                'total' => 0,
                'current_page' => $page,
                'per_page' => $per_page,
                'total_pages' => 0,
                'error' => $e->getMessage()
            ];
        }
    }
}

// Uso del código
$url_base = "https://www.datos.gov.co/resource/ers2-kerr.json";
$api_consumer = new APIConsumer($url_base);
$reportes_por_pagina = 4;
$pagina_actual_api = isset($_GET['pagina_api']) ? (int)$_GET['pagina_api'] : 1;

// Obtener los datos paginados
$resultado_api = $api_consumer->fetchData($pagina_actual_api, $reportes_por_pagina);

// Asignar variables para usar en la vista
$datos_api_pagina = $resultado_api['data'];
$total_paginas_api = $resultado_api['total_pages'];
$total_registros = $resultado_api['total'];

// En caso de error
if (isset($resultado_api['error'])) {
    error_log("Error en la API: " . $resultado_api['error']);
    // Podrías mostrar un mensaje al usuario si lo deseas
}