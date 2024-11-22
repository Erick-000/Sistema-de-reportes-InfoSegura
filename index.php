<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('app/config.php');
// Se incluye el archivo de sesión donde se encuentran las variables de sesión existentes
include('layout/sesion.php');
// Se incluye el archivo donde se encuentra contenido y los nav-bar del sitio
include('layout/parte1.php');
include('app/controllers/usuarios/listado_de_usuarios.php');
include('app/controllers/roles/listado_de_roles.php');
include('app/controllers/categorias/listado_de_categorias.php');  ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">BIENVENIDO AL SISTEMA - <?php echo $rol_sesion; ?></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $contador_no_visitantes = 0; // Inicializamos el contador

              try {
                // Obtenemos el id_rol del rol "VISITANTES"
                $sql_rol = "SELECT id_rol FROM roles WHERE nombre_rol = 'VISITANTE'";
                $query_rol = $pdo->prepare($sql_rol);
                $query_rol->execute();
                $rol = $query_rol->fetch(PDO::FETCH_ASSOC);

                if ($rol) {
                  $id_rol_visitantes = $rol['id_rol'];

                  // Contamos los usuarios que NO tienen el rol "VISITANTES"
                  $sql_contador = "SELECT COUNT(*) as total FROM usuarios WHERE id_rol != :id_rol";
                  $query_contador = $pdo->prepare($sql_contador);
                  $query_contador->bindParam(':id_rol', $id_rol_visitantes, PDO::PARAM_INT);
                  $query_contador->execute();

                  $resultado = $query_contador->fetch(PDO::FETCH_ASSOC);
                  $contador_no_visitantes = $resultado['total'] ?? 0; // Fallback si el resultado es nulo
                }
              } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // En caso de error, muestra el mensaje
              }
              ?>
              <h3><?php echo $contador_no_visitantes; ?></h3>

              <p>Usuarios del sistema</p>
            </div>
            <a href="<?php echo $URL; ?>/usuarios/create.php">
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            </a>
            <a href="<?php echo $URL; ?>/usuarios" class="small-box-footer">
              Más detalles <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>



        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $contador_de_roles = 0;
              foreach ($roles_datos as $roles_dato) {
                $contador_de_roles = $contador_de_roles + 1;
              }
              ?>
              <h3><?php echo $contador_de_roles; ?></h3>

              <p>Roles registrados</p>
            </div>
            <a href="<?php echo $URL; ?>/roles/create.php">
              <div class="icon">
                <i class="fas fa-plus"></i>
              </div>
            </a>
            <a href="<?php echo $URL; ?>/roles" class="small-box-footer">
              Mas detalles <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              $contador_objetos = 0;
              foreach ($categorias_datos as $categoria) {
                if ($categoria['nombre_categoria'] == "OBJETOS RECUPERADOS") {
                  $id_categoria_objetos = $categoria['id_categoria'];

                  // Consulta para contar reportes de esta categoría específica
                  $sql_contador = "SELECT COUNT(*) as total FROM reportes WHERE id_categoria = $id_categoria_objetos";
                  $query_contador = $pdo->prepare($sql_contador);
                  $query_contador->execute();
                  $resultado = $query_contador->fetch(PDO::FETCH_ASSOC);
                  $contador_objetos = $resultado['total'];
                  break;
                }
              }
              ?>
              <h3><?php echo $contador_objetos; ?></h3>

              <p>Objetos Recuperados</p>
            </div>
            <div class="icon">
              <i class="fas fa-box-open"></i>
            </div>
            <a href="<?php echo $URL; ?>/reportes" class="small-box-footer">
              Mas detalles <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              $contador_visitantes = 0;
              // Primero obtenemos el id_rol de VISITANTES
              $sql_rol = "SELECT id_rol FROM roles WHERE nombre_rol = 'VISITANTE'";
              $query_rol = $pdo->prepare($sql_rol);
              $query_rol->execute();
              $rol = $query_rol->fetch(PDO::FETCH_ASSOC);

              if ($rol) {
                $id_rol_visitantes = $rol['id_rol'];

                // Contamos los usuarios que tienen ese id_rol
                $sql_contador = "SELECT COUNT(*) as total FROM usuarios WHERE id_rol = :id_rol";
                $query_contador = $pdo->prepare($sql_contador);
                $query_contador->execute(['id_rol' => $id_rol_visitantes]);
                $resultado = $query_contador->fetch(PDO::FETCH_ASSOC);
                $contador_visitantes = $resultado['total'];
              }
              ?>
              <h3><?php echo $contador_visitantes; ?></h3>

              <p>Visitantes registrados</p>
            </div>
            <div class="icon">
              <i class="fas fa-user"></i>
            </div>
            <a href="<?php echo $URL; ?>/usuarios" class="small-box-footer">
              Mas detalles <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- // Se incluye el archivo donde se encuentra contenido y footer del sitio -->
<?php include('layout/parte2.php'); ?>