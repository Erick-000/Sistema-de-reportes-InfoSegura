<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../app/config.php');
// Se incluye el archivo de sesión donde se encuentran las variables de sesión existentes
include('../layout/sesion.php');
// Se incluye el archivo donde se encuentra contenido y los nav-bar del sitio
include('../layout/parte1.php');

include('../app/controllers/reportes/cargar_reporte.php');

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
                    <h1 class="m-0">Datos del reporte: <?php echo $titulo ?> a ser eliminado</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-file-alt mr-2"></i>Eliminar
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                       <form action="../app/controllers/reportes/delete.php" method="post" >
                       <input type="text" name="id_reporte" value="<?php echo $id_reporte_get; ?>" hidden>
                       <div class="card-body">
                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="titulo">
                                            <i class="fas fa-heading mr-1"></i>Título del Reporte
                                        </label required>
                                        <input type="text" class="form-control" id="titulo" value=" <?php echo $titulo; ?>" name="titulo" readonly
                                            placeholder="Ingrese el título del reporte">
                                    </div>

                                    <div class="form-group">
                                        <label for="descripcion">
                                            <i class="fas fa-align-left mr-1"></i>Descripción
                                        </label required>
                                        <textarea class="form-control" id="descripcion" name="descripcion" readonly rows="4"
                                            placeholder="Ingrese una descripción detallada"><?php echo $descripcion; ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="categoria">
                                                    <i class="fas fa-tag mr-1"></i>Categoría
                                                    <input type="text" class="form-control" name="" id="" value="<?php echo $nombre_categoria; ?>" readonly>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha">
                                                    <i class="fas fa-calendar-alt mr-1"></i>Fecha del Reporte
                                                </label>
                                                <input type="datetime" class="form-control" value="<?php echo $fecha; ?>" id="fecha" name="fecha" readonly>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="publicado">
                                            <i class="fas fa-user mr-1"></i>Publicado por
                                        </label>
                                        <input type="text" class="form-control" value="<?php echo $email_usuario; ?>" id="publicado" name="publicado" readonly>
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
                                            <center>
                                                <img src="<?php echo $URL . "/reportes/img_reportes/" . $imagen; ?>" width="100%" alt="">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="index.php" class="btn btn-secondary">
                                        Cancelar
                                    </a>
                                    <button class="btn btn-danger" >
                                        <i class="fa fa-trash"></i>
                                        Eliminar producto 
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