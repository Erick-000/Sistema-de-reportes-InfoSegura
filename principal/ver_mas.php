<?php
include('../app/config.php');
include('../layout/nav_var_principal.php');
include('../app/controllers/categorias/listado_de_categorias.php');
include('../app/controllers/reportes/listado_de_reportes.php');

// Verificar si el ID de reporte está en la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Error: ID de reporte no especificado.";
    exit(); // Detener la ejecución si no se especifica el ID
}

// Obtener el ID del reporte desde la URL
$id_reporte = $_GET['id'];

// Consulta para obtener los detalles del reporte
$sql_reporte = "SELECT 
    r.*, 
    u.nombre AS nombre_usuario,
    c.nombre_categoria AS nombre_categoria  -- Asegúrate de usar el nombre correcto de la columna
    FROM reportes r 
    INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
    INNER JOIN categorias c ON r.id_categoria = c.id_categoria
    WHERE r.id_reporte = ?";


$stmt = $pdo->prepare($sql_reporte);
$stmt->execute([$id_reporte]);
$reporte = $stmt->fetch();

// Verificar si el reporte existe
if (!$reporte) {
    echo "Error: Reporte no encontrado.";
    exit(); // Detener la ejecución si no se encuentra el reporte
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($reporte['titulo']); ?> - InfoSegura</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/principal.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/footer.css">
</head>
<body>
    <div class="container my-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../principal.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($reporte['titulo']); ?></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8">
                <article class="blog-post">
                    <h1 class="display-5 mb-4"><?php echo htmlspecialchars($reporte['titulo']); ?></h1>
                    
                    <div class="meta-info mb-4">
                        <span class="text-muted me-3">
                            <i class="fas fa-user me-1"></i>
                            <?php echo htmlspecialchars($reporte['nombre_usuario']); ?>
                        </span>
                        <span class="text-muted me-3">
                            <i class="fas fa-calendar me-1"></i>
                            <?php echo htmlspecialchars($reporte['fyh_creacion']); ?>
                        </span>
                        <span class="text-muted">
                            <i class="fas fa-folder me-1"></i>
                            <?php echo htmlspecialchars($reporte['nombre_categoria']); ?>
                        </span>
                    </div>

                    <img src="<?php echo $URL . "../reportes/img_reportes/" . htmlspecialchars($reporte['imagen']); ?>"
                         class="img-fluid rounded mb-4" alt="Imagen del reporte">

                    <div class="reporte-contenido">
                        <?php echo nl2br(htmlspecialchars($reporte['descripcion'])); ?>
                    </div>
                </article>

                <div class="mt-5">
                    <a href="../principal.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>
                        Volver a los reportes
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Sidebar con información adicional o reportes relacionados -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Información adicional</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-clock me-2"></i>
                                Última actualización: <?php echo htmlspecialchars($reporte['fyh_actualizacion'] ?? $reporte['fecha_creacion']); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir el footer -->
    <?php include('../layout/footer_principal.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
