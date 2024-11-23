<?php
include('../app/config.php');
include('../layout/sesion.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - InfoSegura</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/footer.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/nosotros.css">
</head>

<body>
    <!-- Navbar -->
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
                    <a class="nav-link" href="<?php echo $URL; ?>/principal.php"><i class="fas fa-home me-1"></i>Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $URL; ?>/principal/nosotros.php"><i class="fas fa-info-circle me-1"></i>Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $URL; ?>/principal.php"><i class="fas fa-file-alt me-1"></i>Reportes</a>
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
            <h1><i class="fas fa-users me-2"></i>Nosotros</h1>
            <p class="lead">Conoce más sobre InfoSegura y nuestra misión.</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container my-5">
        <!-- Misión y Visión -->
        <div class="row mb-5">
            <div class="col-md-6">
                <h2><i class="fas fa-bullseye me-2"></i>Misión</h2>
                <p>
                    Brindar acceso a información confiable y actualizada para promover la transparencia,
                    la seguridad y el desarrollo comunitario en el Chocó y otras regiones de Colombia.
                </p>
            </div>
            <div class="col-md-6">
                <h2><i class="fas fa-eye me-2"></i>Visión</h2>
                <p>
                    Ser la plataforma líder en la región para la consulta de datos y reportes, apoyando
                    iniciativas de desarrollo social y comunitario basadas en información.
                </p>
            </div>
        </div>

        <!-- Valores -->
        <div class="row mb-5">
            <div class="col-12">
                <h2><i class="fas fa-star me-2"></i>Valores</h2>
                <ul>
                    <li><strong>Transparencia:</strong> Nos esforzamos por proporcionar información clara y verificable.</li>
                    <li><strong>Compromiso:</strong> Estamos dedicados a fortalecer a las comunidades a través de la información.</li>
                    <li><strong>Colaboración:</strong> Trabajamos de la mano con la comunidad y las instituciones locales.</li>
                    <li><strong>Innovación:</strong> Utilizamos tecnología moderna para ofrecer soluciones efectivas.</li>
                </ul>
            </div>
        </div>

        <!-- Equipo -->
        <div class="row mb-5">
            <div class="col-12">
                <h2><i class="fas fa-users-cog me-2"></i>Equipo</h2>
                <p>
                    Nuestro equipo está compuesto por profesionales apasionados por la tecnología y el impacto social,
                    comprometidos con el desarrollo sostenible del Chocó y otras regiones.
                </p>
            </div>
        </div>

        <!-- Contacto -->
        <div class="row">
            <div class="col-12">
                <h2><i class="fas fa-envelope me-2"></i>Contacto</h2>
                <p>¿Tienes preguntas o quieres colaborar con nosotros? Escríbenos a:</p>
                <ul>
                    <li><strong>Correo:</strong> contacto@infosegura.com</li>
                    <li><strong>Teléfono:</strong> +57 123 456 7890</li>
                    <li><strong>Dirección:</strong> Calle 123, Ciudad, Chocó, Colombia</li>
                </ul>
            </div>
        </div>
    </div>

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
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="<?php echo $URL; ?>/principal/politica_privacidad.php">Política de Privacidad</a></li>
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
