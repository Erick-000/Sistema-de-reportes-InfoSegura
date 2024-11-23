<?php
include('app/config.php');
include('app/controllers/categorias/listado_de_categorias.php');
include('app/controllers/reportes/listado_de_reportes.php');
include('layout/sesion.php');
include('app/controllers/api/consumo_api_principal.php');
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
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/footer.css">
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
                        <a class="nav-link" href="<?php echo $URL; ?>/principal/nosotros.php"><i class="fas fa-info-circle me-1"></i>Nosotros</a>
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
                        <div class="meta-top mb-2">
                        </div>
                        <h5 class="card-title"><?php echo htmlspecialchars($reporte['titulo']); ?></h5>
                        <p class="card-text flex-grow-1">
                            <?php echo htmlspecialchars(substr($reporte['descripcion'], 0, 100)) . '...'; ?>
                        </p>
                        <div class="meta-info">
                            <small class="text-muted d-block">
                                <i class="fas fa-user me-1"></i>Subido por: <?php echo htmlspecialchars($reporte['nombre_usuario']); ?>
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-list me-1"></i>Categoria: <?php echo htmlspecialchars($reporte['nombre_categoria']); ?>
                            </small>
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar-alt me-1"></i>Fecha de publicación: <?php echo htmlspecialchars($reporte['fecha_creacion']); ?>
                            </small>
                        </div>
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

    <div class="container mt-5">
    <h2 class="mb-4">Datos que te pueden interesar</h2>
    <div class="row">
        <?php if (!empty($datos_api_pagina)): ?>
            <?php foreach ($datos_api_pagina as $dato): ?>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                Año del Hecho: <?php echo htmlspecialchars($dato['a_o_del_hecho'] ?? 'No disponible'); ?>
                            </h5>
                            <p class="card-text">
                                Sexo de la Víctima: <?php echo htmlspecialchars($dato['sexo_de_la_victima'] ?? 'No disponible'); ?>
                            </p>
                            <p class="card-text">
                                Municipio: <?php echo htmlspecialchars($dato['municipio_del_hecho_dane'] ?? 'No disponible'); ?>
                            </p>
                            <p class="card-text">
                                Contexto: <?php echo htmlspecialchars($dato['contexto_de_violencia'] ?? 'No disponible'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">No hay datos disponibles desde la API.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Paginación para datos de la API -->
    <nav>
        <ul class="pagination justify-content-center mt-4">
            <!-- Botón para ir a la primera página -->
            <?php if ($pagina_actual_api > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina_api=1" aria-label="Primera">
                        <i class="fas fa-angle-double-left"></i> Primera
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?pagina_api=<?php echo $pagina_actual_api - 1; ?>" aria-label="Anterior">
                        <i class="fas fa-chevron-left"></i> Anterior
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <a class="page-link" aria-label="Primera">
                        <i class="fas fa-angle-double-left"></i> Primera
                    </a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" aria-label="Anterior">
                        <i class="fas fa-chevron-left"></i> Anterior
                    </a>
                </li>
            <?php endif; ?>

            <!-- Números de página -->
            <?php
            $rango_paginas = 2; // Número de páginas visibles antes y después de la actual
            $pagina_inicio = max(1, $pagina_actual_api - $rango_paginas);
            $pagina_fin = min($total_paginas_api, $pagina_actual_api + $rango_paginas);
            ?>
            <?php for ($i = $pagina_inicio; $i <= $pagina_fin; $i++): ?>
                <li class="page-item <?php echo ($i === $pagina_actual_api) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina_api=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <!-- Botón para ir a la última página -->
            <?php if ($pagina_actual_api < $total_paginas_api): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina_api=<?php echo $pagina_actual_api + 1; ?>" aria-label="Siguiente">
                        Siguiente <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?pagina_api=<?php echo $total_paginas_api; ?>" aria-label="Última">
                        Última <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <a class="page-link" aria-label="Siguiente">
                        Siguiente <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" aria-label="Última">
                        Última <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>


    <!-- Footer -->
    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>Acerca de</h6>
                    <p class="text-justify">InfoSegura busca brindar acceso a información confiable y actualizada sobre los reportes en tu comunidad. Nuestra misión es mantenerte informado y conectado con lo que sucede a tu alrededor.</p>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Enlaces Rápidos</h6>
                    <ul class="footer-links">
                        <li><a href="<?php echo $URL; ?>/principal/nosotros.php">Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2024 Todos los derechos reservados por
                        <a href="#">InfoSegura</a>.
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>