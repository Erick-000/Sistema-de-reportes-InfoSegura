<!-- Navbar -->
<?php 
session_start(); // Iniciar la sesión
// Verificar si el usuario está logueado
if (isset($_SESSION['sesion_email'])) {
    // El usuario está logueado, puedes acceder a su información
    $usuario_email = $_SESSION['sesion_email'];
    $usuario_nombre = $_SESSION['nombre_usuario'] ?? 'Usuario';
    $usuario_rol = $_SESSION['id_rol'] ?? null;
} else {
    // El usuario no está logueado
    $usuario_email = null;
    $usuario_nombre = 'Usuario';
    $usuario_rol = null;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $URL; ?>">
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
                    <a class="nav-link" href="<?php echo $URL; ?>/principal.php"><i class="fas fa-file-alt me-1"></i>Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $URL; ?>/principal/nosotros.php"><i class="fas fa-info-circle me-1"></i>Nosotros</a>
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
                                    <a class="dropdown-item" href="<?php echo $URL; ?>/registro/registro.php">
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