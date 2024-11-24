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
    <title>Política de Privacidad - InfoSegura</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/footer.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/nosotros.css">
</head>

<body>
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


    <?php include('../layout/footer_principal.php'); ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>