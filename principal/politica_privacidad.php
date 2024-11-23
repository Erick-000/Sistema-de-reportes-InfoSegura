<?php
include('../app/config.php');
include('../layout/sesion.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad - InfoSegura</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/footer.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/nosotros.css">
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
                        <a class="nav-link" href="<?php echo $URL; ?>/principal.php"><i class="fas fa-home me-1"></i>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $URL; ?>/principal/nosotros.php"><i class="fas fa-info-circle me-1"></i>Nosotros</a>
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
                            ?>
                                <li><span class="dropdown-item-text">
                                        <i class="fas fa-user-circle me-2"></i>
                                        <?php echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario'); ?>
                                    </span></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php
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
            <h1><i class="fas fa-user-shield me-2"></i>Política de Privacidad</h1>
            <p class="lead">Conoce cómo protegemos tu información en InfoSegura</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container my-5">
        <!-- Introducción -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-info-circle me-2"></i>Introducción</h2>
                <p>
                    En InfoSegura, nos tomamos muy en serio la protección de tus datos personales. Esta Política de Privacidad
                    describe cómo recopilamos, utilizamos y protegemos tu información cuando utilizas nuestra plataforma.
                    Al usar nuestros servicios, aceptas las prácticas descritas en esta política.
                </p>
            </div>
        </div>

        <!-- Recopilación de Información -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-database me-2"></i>Información que Recopilamos</h2>
                <h4>Información que nos proporcionas:</h4>
                <ul>
                    <li>Datos de registro (nombre, correo electrónico, contraseña)</li>
                    <li>Información de perfil</li>
                    <li>Contenido de los reportes que realizas</li>
                    <li>Comunicaciones con nuestro equipo de soporte</li>
                </ul>
                <h4>Información recopilada automáticamente:</h4>
                <ul>
                    <li>Dirección IP</li>
                    <li>Tipo de navegador y dispositivo</li>
                    <li>Datos de uso de la plataforma</li>
                    <li>Cookies y tecnologías similares</li>
                </ul>
            </div>
        </div>

        <!-- Uso de la Información -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-cog me-2"></i>Uso de la Información</h2>
                <p>Utilizamos tu información para:</p>
                <ul>
                    <li>Proporcionar y mantener nuestros servicios</li>
                    <li>Mejorar y personalizar tu experiencia</li>
                    <li>Procesar y gestionar los reportes</li>
                    <li>Comunicarnos contigo sobre actualizaciones o cambios</li>
                    <li>Prevenir actividades fraudulentas y mejorar la seguridad</li>
                    <li>Cumplir con obligaciones legales</li>
                </ul>
            </div>
        </div>

        <!-- Compartir Información -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-share-alt me-2"></i>Compartir Información</h2>
                <p>Podemos compartir tu información con:</p>
                <ul>
                    <li>Autoridades competentes cuando sea requerido por ley</li>
                    <li>Proveedores de servicios que nos ayudan a operar la plataforma</li>
                    <li>Otros usuarios según las configuraciones de privacidad que elijas</li>
                </ul>
                <p>No vendemos ni alquilamos tu información personal a terceros.</p>
            </div>
        </div>

        <!-- Seguridad -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-lock me-2"></i>Seguridad de la Información</h2>
                <p>
                    Implementamos medidas de seguridad técnicas y organizativas para proteger tu información, incluyendo:
                </p>
                <ul>
                    <li>Encriptación de datos sensibles</li>
                    <li>Controles de acceso estrictos</li>
                    <li>Monitoreo regular de seguridad</li>
                    <li>Copias de seguridad periódicas</li>
                </ul>
            </div>
        </div>

        <!-- Derechos del Usuario -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-user-check me-2"></i>Tus Derechos</h2>
                <p>Tienes derecho a:</p>
                <ul>
                    <li>Acceder a tu información personal</li>
                    <li>Rectificar datos inexactos</li>
                    <li>Solicitar la eliminación de tus datos</li>
                    <li>Oponerte al procesamiento de tu información</li>
                    <li>Recibir una copia de tus datos</li>
                </ul>
            </div>
        </div>

        <!-- Contacto -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-envelope me-2"></i>Contacto sobre Privacidad</h2>
                <p>
                    Si tienes preguntas sobre esta política o cómo manejamos tu información, contáctanos:
                </p>
                <ul>
                    <li>Email: privacidad@infosegura.com</li>
                    <li>Teléfono: +57 123 456 7890</li>
                    <li>Dirección: Calle 123, Ciudad, Chocó, Colombia</li>
                </ul>
            </div>
        </div>

        <!-- Actualización de la Política -->
        <div class="row">
            <div class="col-12">
                <h2><i class="fas fa-history me-2"></i>Actualizaciones de la Política</h2>
                <p>
                    Podemos actualizar esta política periódicamente. La fecha de la última actualización aparecerá en esta página.
                    Al continuar usando nuestros servicios después de los cambios, aceptas la política actualizada.
                </p>
                <p class="text-muted">
                    Última actualización: 23 de noviembre de 2024
                </p>
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