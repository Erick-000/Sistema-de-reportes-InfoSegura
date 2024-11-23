<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../app/config.php');
// Se incluye el archivo de sesión donde se encuentran las variables de sesión existentes
include('../layout/sesion.php');
// Se incluye el archivo donde se encuentra contenido y los nav-bar del sitio
include('../layout/parte1.php');

include('../app/controllers/usuarios/show_usuario.php')

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Eliminar usuario</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Eliminar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="../app/controllers/usuarios/delete_usuario.php" method="post">
                                    <input type="text" name="id_usuario" value="<?php echo $id_usuario_get; ?>"hidden>    
                                    <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" value="<?php echo $nombre; ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" disabled>
                                        </div>
                                       <div class="form-group">
                                            <label for="">Rol del usuario</label>
                                            <input type="text" name="rol" value="<?php echo $rol; ?>" class="form-control" disabled>
                                        </div> 
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Volver</a>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- // Se incluye el archivo donde se encuentra contenido y footer del sitio -->
<?php include('../layout/parte2.php'); ?>
<?php include('../layout/mensajes.php'); ?>