<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../app/config.php');
// Se incluye el archivo de sesión donde se encuentran las variables de sesión existentes
include('../layout/sesion.php');
// Se incluye el archivo donde se encuentra contenido y los nav-bar del sitio
include('../layout/parte1.php');

include('../app/controllers/reportes/listado_de_reportes.php');

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
                    <h1 class="m-0">Registro de Nuevo Reporte</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-file-alt mr-2"></i>Crear Nuevo Reporte
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="../app/controllers/reportes/create.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Columna izquierda -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="titulo">
                                                <i class="fas fa-heading mr-1"></i>Título del Reporte
                                            </label required >
                                            <input type="text" class="form-control" id="titulo" name="titulo" required
                                                placeholder="Ingrese el título del reporte">
                                        </div>

                                        <div class="form-group">
                                            <label for="descripcion">
                                                <i class="fas fa-align-left mr-1"></i>Descripción
                                            </label required >
                                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                                placeholder="Ingrese una descripción detallada"></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoria">
                                                        <i class="fas fa-tag mr-1"></i>Categoría
                                                    </label>
                                                    <select name="categoria" id="categoria" class="form-control select2">
                                                        <option value="">Seleccione una categoría</option required>
                                                        <?php foreach ($categorias_datos as $categoria): ?>
                                                            <option value="<?php echo $categoria['id_categoria']; ?>">
                                                                <?php echo $categoria['nombre_categoria']; ?>
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
                                                    <input type="datetime" class="form-control" value="<?php echo date('Y-m-d H:i'); ?>" id="fecha" name="fecha" readonly>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="publicado">
                                                <i class="fas fa-user mr-1"></i>Publicado por
                                            </label>
                                            <input type="text" class="form-control" value="<?php echo $email_sesion; ?>" id="publicado" name="publicado" readonly>
                                            <input type="text" class="form-control" value="<?php echo $id_usuario_sesion; ?>" id="publicado" name="id_usuario" hidden>
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
                                                        <img id="preview-image" src="../public/images/placeholder-image.png"
                                                            class="img-fluid rounded shadow-sm" alt="Preview">
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file" name="imagen"
                                                            accept="image/*">
                                                        <label class="custom-file-label" for="file">Elegir archivo</label>
                                                    </div>
                                                    <small class="form-text text-muted mt-2">
                                                        Formatos permitidos: JPG, PNG, GIF. Máximo 5MB
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Script para la previsualización de imagen -->
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const fileInput = document.getElementById('file');
                                            const previewImage = document.getElementById('preview-image');
                                            const fileLabel = document.querySelector('.custom-file-label');
                                            const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB

                                            fileInput.addEventListener('change', function(e) {
                                                const file = e.target.files[0];

                                                if (file) {
                                                    // Actualizar nombre del archivo en el label
                                                    fileLabel.textContent = file.name;

                                                    // Validar tipo de archivo
                                                    if (!file.type.match('image.*')) {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Archivo no válido',
                                                            text: 'Por favor, seleccione una imagen válida'
                                                        });
                                                        fileInput.value = '';
                                                        return;
                                                    }

                                                    // Validar tamaño
                                                    if (file.size > MAX_FILE_SIZE) {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Archivo demasiado grande',
                                                            text: 'La imagen no debe exceder los 5MB'
                                                        });
                                                        fileInput.value = '';
                                                        return;
                                                    }

                                                    // Previsualizar imagen
                                                    const reader = new FileReader();
                                                    reader.onload = function(e) {
                                                        previewImage.src = e.target.result;
                                                        previewImage.classList.add('shadow');
                                                    };
                                                    reader.onerror = function() {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error',
                                                            text: 'Error al cargar la imagen'
                                                        });
                                                    };
                                                    reader.readAsDataURL(file);
                                                }
                                            });

                                            // Drag and drop
                                            const uploadContainer = document.querySelector('.image-upload-container');

                                            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                                                uploadContainer.addEventListener(eventName, preventDefaults, false);
                                            });

                                            function preventDefaults(e) {
                                                e.preventDefault();
                                                e.stopPropagation();
                                            }

                                            ['dragenter', 'dragover'].forEach(eventName => {
                                                uploadContainer.addEventListener(eventName, highlight, false);
                                            });

                                            ['dragleave', 'drop'].forEach(eventName => {
                                                uploadContainer.addEventListener(eventName, unhighlight, false);
                                            });

                                            function highlight() {
                                                uploadContainer.classList.add('border-primary');
                                            }

                                            function unhighlight() {
                                                uploadContainer.classList.remove('border-primary');
                                            }

                                            uploadContainer.addEventListener('drop', handleDrop, false);

                                            function handleDrop(e) {
                                                const dt = e.dataTransfer;
                                                const file = dt.files[0];
                                                fileInput.files = dt.files;
                                                fileInput.dispatchEvent(new Event('change'));
                                            }
                                        });
                                    </script>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="index.php" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Realizar Reporte
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