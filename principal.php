<?php
include('app/config.php');
include('app/controllers/categorias/listado_de_categorias.php');
include('app/controllers/reportes/listado_de_reportes.php');
include('layout/sesion.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Recientes - InfoSegura</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/principal.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt me-2"></i>InfoSegura
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-1"></i>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle me-1"></i>Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-file-alt me-1"></i>Reportes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i>
                            <?php
                            if (isset($_SESSION['sesion_email'])) {
                                echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario');
                            } else {
                                echo 'Usuario';
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php
                            if (isset($_SESSION['sesion_email'])) {
                                // Usuario con sesión iniciada
                            ?>
                                <li><span class="dropdown-item-text">
                                        <i class="fas fa-user-circle me-2"></i>
                                        <?php echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario'); ?>
                                    </span></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php
                                // Verificar si es administrador (id_rol = 1)
                                if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1) {
                                ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo $URL; ?>/index.php">
                                            <i class="fas fa-cogs me-2"></i>Ir al panel de administración
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                <?php
                                }
                                ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo $URL; ?>/app/controllers/login/cerrar_sesion.php">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                    </a>
                                </li>
                            <?php
                            } else {
                                // Usuario sin sesión
                            ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo $URL; ?>/registro">
                                        <i class="fas fa-user-plus me-2"></i>Registrarse
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo $URL; ?>/login">
                                        <i class="fas fa-door-open me-2"></i>Iniciar Sesión
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="page-header">
        <div class="container">
            <h1><i class="fas fa-file-alt me-2"></i>Reportes Recientes</h1>
            <p class="lead">Mantente informado sobre los últimos acontecimientos en tu comunidad</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container">
        <div class="row">
            <?php

            // Configuración de la paginación
            $reportes_por_pagina = 4;
            $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $total_reportes = count($reportes_datos);
            $total_paginas = ceil($total_reportes / $reportes_por_pagina);

            // Calcular el índice inicial y final para la página actual
            $indice_inicial = ($pagina_actual - 1) * $reportes_por_pagina;
            $reportes_pagina = array_slice($reportes_datos, $indice_inicial, $reportes_por_pagina);

            foreach ($reportes_pagina as $reporte) { ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?php echo $URL . "/reportes/img_reportes/" . htmlspecialchars($reporte['imagen']); ?>"
                            class="card-img-top" alt="Imagen del reporte">
                        <div class="card-body d-flex flex-column">
                            <span class="category-badge">
                                <?php echo htmlspecialchars($reporte['nombre_categoria']); ?>
                            </span>
                            <h5 class="card-title"><?php echo htmlspecialchars($reporte['titulo']); ?></h5>
                            <p class="card-text flex-grow-1">
                                <?php echo htmlspecialchars(substr($reporte['descripcion'], 0, 100)) . '...'; ?>
                            </p>
                            <div class="meta-info">
                                <p class="mb-2">
                                    <i class="fas fa-user me-1"></i>
                                    <?php echo htmlspecialchars($reporte['nombre_usuario']); ?>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    <?php echo htmlspecialchars($reporte['fecha_creacion']); ?>
                                </p>
                            </div>
                            <a href="#" class="btn btn-primary mt-3">
                                <i class="fas fa-eye me-1"></i>Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Navegación de reportes">
                <ul class="pagination">
                    <?php if ($pagina_actual > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="page-item <?php echo ($i == $pagina_actual) ? 'active' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($pagina_actual < $total_paginas): ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2024 InfoSegura. Todos los derechos reservados.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>