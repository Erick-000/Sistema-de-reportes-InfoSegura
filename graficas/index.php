<?php
// Configuración del idioma para mostrar meses en español
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');

// Se incluyen los archivos necesarios
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/reportes/listado_de_reportes.php');

// Consulta para obtener reportes agrupados por mes
$sql_reportes = "SELECT 
    DATE_FORMAT(fyh_creacion, '%c') as mes_numero,
    DATE_FORMAT(fyh_creacion, '%Y') as anio,
    COUNT(*) as total_incidentes
FROM 
    reportes 
GROUP BY 
    DATE_FORMAT(fyh_creacion, '%Y-%m')
ORDER BY 
    anio, mes_numero";

$query_reportes = $pdo->prepare($sql_reportes);
$query_reportes->execute();
$reportes_por_mes = $query_reportes->fetchAll(PDO::FETCH_ASSOC);

// Preparar datos para la gráfica
$meses = [];
$totales = [];
foreach ($reportes_por_mes as $reporte) {
    // Convertir número del mes al nombre en español
    $mes_nombre = strftime('%B', mktime(0, 0, 0, $reporte['mes_numero']));
    $meses[] = ucfirst($mes_nombre) . " " . $reporte['anio']; // Ejemplo: Enero 2024
    $totales[] = $reporte['total_incidentes'];
}

// Agregar estadísticas generales
$total_reportes = 0;
$reportes_por_categoria = [];

if (isset($reportes_datos)) {
    foreach ($reportes_datos as $reporte) {
        $total_reportes++;
        // Contamos reportes por categoría
        $categoria = $reporte['nombre_categoria'] ?? 'Sin categoría';
        if (!isset($reportes_por_categoria[$categoria])) {
            $reportes_por_categoria[$categoria] = 0;
        }
        $reportes_por_categoria[$categoria]++;
    }
}
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tendencia de Incidentes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/">Inicio</a></li>
                        <li class="breadcrumb-item active">Tendencia de Incidentes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Resumen de estadísticas -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_reportes; ?></h3>
                            <p>Total de Reportes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo count($reportes_por_categoria); ?></h3>
                            <p>Categorías Activas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo max($totales); ?></h3>
                            <p>Máximo Mensual</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo round(array_sum($totales) / count($totales), 1); ?></h3>
                            <p>Promedio Mensual</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Gráfica de tendencia -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-1"></i>
                                Incidentes Reportados por Mes
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="reportesChart" style="min-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráfica de categorías -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Distribución por Categoría
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="categoriasChart" style="min-height: 200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Configuración de la gráfica de línea
const ctxLine = document.getElementById('reportesChart').getContext('2d');
new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($meses); ?>,
        datasets: [{
            label: 'Número de Incidentes',
            data: <?php echo json_encode($totales); ?>,
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointRadius: 4,
            pointBackgroundColor: '#007bff',
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#0056b3'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: {
                display: true,
                text: 'Tendencia de Incidentes Mensuales',
                font: {
                    size: 16
                }
            },
            legend: {
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Gráfica de categorías
const ctxPie = document.getElementById('categoriasChart').getContext('2d');
new Chart(ctxPie, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode(array_keys($reportes_por_categoria)); ?>,
        datasets: [{
            data: <?php echo json_encode(array_values($reportes_por_categoria)); ?>,
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#ffc107',
                '#dc3545',
                '#17a2b8',
                '#6c757d'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

<?php include('../layout/parte2.php'); ?>
