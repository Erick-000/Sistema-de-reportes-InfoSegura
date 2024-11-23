<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../app/config.php');
// Se incluye el archivo de sesión donde se encuentran las variables de sesión existentes
include('../layout/sesion.php');
// Se incluye el archivo donde se encuentra contenido y los nav-bar del sitio
include('../layout/parte1.php');

include('../app/controllers/reportes/cargar_reporte.php');
include('../app/controllers/categorias/listado_de_categorias.php');

?>

<!-- Estilos CSS adicionales -->
<style>
    .image-upload-container {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 20px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .image-upload-container:hover {
        border-color: #007bff;
        background: #fff;
    }

    #preview-container {
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #preview-image {
        max-height: 300px;
        object-fit: contain;
    }

    .custom-file-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar Reporte</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-file-alt mr-2"></i>Actualizar
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="../app/controllers/reportes/update.php" method="post"enctype="multipart/form-data">
                                <input type="text" value="<?php echo $id_reporte_get; ?>" name="id_reporte" hidden>
                            <div class="row">
                                    <!-- Columna izquierda -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="titulo">
                                                <i class="fas fa-heading mr-1"></i>Título del Reporte
                                            </label required>
                                            <input type="text" value="<?php echo $titulo; ?>" class="form-control" id="titulo" name="titulo" required
                                                placeholder="Ingrese el título del reporte">
                                        </div>

                                        <div class="form-group">
                                            <label for="descripcion">
                                                <i class="fas fa-align-left mr-1"></i>Descripción
                                            </label required>
                                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                                placeholder="Ingrese una descripción detallada"><?php echo $descripcion; ?></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoria">
                                                        <i class="fas fa-tag mr-1"></i>Categoría
                                                    </label>
                                                    <select name="categoria" id="categoria"
                                                        class="form-control select2" required>
                                                        <?php foreach ($categorias_datos as $categoria):
                                                            $nombre_categoria_tabla = $categoria['nombre_categoria'];
                                                            $id_categoria = $categoria['id_categoria'];?>
                                                            <option value="<?php echo $id_categoria; ?>" <?php if ($nombre_categoria_tabla == "$nombre_categoria") { ?> selected="selected" <?php }
                                                            ?>> <?php echo $nombre_categoria_tabla; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha">
                                                        <i class="fas fa-calendar-alt mr-1"></i>Fecha del Reporte
                                                    </label>
                                                    <input type="datetime" class="form-control"
                                                        value="<?php echo $fecha; ?>" id="fecha" name="fecha"
                                                        readonly>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="publicado">
                                                <i class="fas fa-user mr-1"></i>Publicado por
                                            </label>
                                            <input type="text" class="form-control" value="<?php echo $email_sesion; ?>"
                                                id="publicado" name="publicado" readonly>
                                            <input type="text" class="form-control"
                                                value="<?php echo $id_usuario; ?>" id="publicado"
                                                name="id_usuario" hidden>
                                        </div>
                                    </div>

                                    <!-- Columna derecha - Imagen -->
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h3 class="card-title">
                                                    <i class="fas fa-image mr-1"></i>Imagen del Reporte
                                                </h3>
                                            </div>
                                            <div class="card-body text-center">
                                                <div class="image-upload-container">
                                                    <div id="preview-container" class="mb-3">
                                                        <img id="preview-image"
                                                            src="<?php echo $URL . "/reportes/img_reportes/" . $imagen; ?>"
                                                            class="img-fluid rounded shadow-sm" alt="Preview">
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file"
                                                            name="imagen" accept="image/*">
                                                            <input type="text" name="imagen_text" value="<?php echo $imagen; ?>" hidden>
                                                        <label class="custom-file-label" for="file">Elegir
                                                            archivo</label>
                                                    </div>
                                                    <small class="form-text text-muted mt-2">
                                                        Formatos permitidos: JPG, PNG, GIF. Máximo 5MB
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Obtener referencias a los elementos
                                            const fileInput = document.getElementById('file');
                                            const previewImage = document.getElementById('preview-image');
                                            const fileLabel = document.querySelector('.custom-file-label');

                                            // Función para previsualizar la imagen seleccionada
                                            function previewSelectedImage(event) {
                                                const file = event.target.files[0];

                                                // Validar que se haya seleccionado un archivo
                                                if (!file) {
                                                    return;
                                                }

                                                // Validar tipo de archivo
                                                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                                if (!validImageTypes.includes(file.type)) {
                                                    alert('Por favor, selecciona un archivo de imagen válido (JPG, PNG, GIF)');
                                                    fileInput.value = ''; // Limpiar el input
                                                    fileLabel.textContent = 'Elegir archivo';
                                                    return;
                                                }

                                                // Validar tamaño del archivo (5MB máximo)
                                                const maxSize = 5 * 1024 * 1024; // 5MB
                                                if (file.size > maxSize) {
                                                    alert('El archivo es demasiado grande. Máximo 5MB');
                                                    fileInput.value = ''; // Limpiar el input
                                                    fileLabel.textContent = 'Elegir archivo';
                                                    return;
                                                }

                                                // Crear un lector de archivos
                                                const reader = new FileReader();

                                                // Cuando la imagen se cargue, mostrar la previsualización
                                                reader.onload = function(e) {
                                                    previewImage.src = e.target.result;
                                                    fileLabel.textContent = file.name; // Mostrar nombre del archivo
                                                };

                                                // Leer el archivo como URL
                                                reader.readAsDataURL(file);
                                            }

                                            // Agregar evento de cambio al input de archivo
                                            fileInput.addEventListener('change', previewSelectedImage);

                                            // Previsualizar imagen existente (si la hay)
                                            <?php if (!empty($imagen_actual)): ?>
                                                previewImage.src = '<?php echo $URL . "/reportes/img_reportes/" . $imagen; ?>';
                                            <?php endif; ?>
                                        });
                                    </script>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="index.php" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            Actualizar Reporte
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- // Se incluye el archivo donde se encuentra contenido y footer del sitio -->
<?php include('../layout/parte2.php'); ?>
<?php include('../layout/mensajes.php'); ?>