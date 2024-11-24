<?php
include('../app/config.php');
include('../layout/nav_var_principal.php');
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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - InfoSegura</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>../public/css/footer.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>../public/css/nosotros.css">
</head>

<body>

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
                    la seguridad y el desarrollo comunitario en el Chocó.
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
                    <li><strong>Teléfono:</strong> +57 321 923 1404</li>
                    <li><strong>Dirección:</strong> Quibdó, Chocó, Colombia</li>
                </ul>
            </div>
        </div>
    </div>

  <?php include('../layout/footer_principal.php') ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
