<?php
// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../app/config.php');
// Se incluye el archivo de sesión donde se encuentran las variables de sesión existentes
include('../layout/sesion.php');
// Se incluye el archivo donde se encuentra contenido y los nav-bar del sitio
include('../layout/parte1.php');
include('../app/controllers/api/consumo_api_admin.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Listado de Reportes de Violencia Infantil</h1>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Datos Consumidos desde la API</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>#</center></th>
                    <th><center>Año del Hecho</center></th>
                    <th><center>Sexo de la Víctima</center></th>
                    <th><center>Municipio</center></th>
                    <th><center>Contexto de Violencia</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($datos_api)) {
                      $contador = 0;
                      foreach ($datos_api as $dato) {
                          $contador++;
                          $a_o_del_hecho = isset($dato['a_o_del_hecho']) ? $dato['a_o_del_hecho'] : 'No disponible';
                          $sexo_de_la_victima = isset($dato['sexo_de_la_victima']) ? $dato['sexo_de_la_victima'] : 'No disponible';
                          $municipio_del_hecho = isset($dato['municipio_del_hecho_dane']) ? $dato['municipio_del_hecho_dane'] : 'No disponible';
                          $contexto_de_violencia = isset($dato['contexto_de_violencia']) ? $dato['contexto_de_violencia'] : 'No disponible';

                          echo "
                          <tr>
                            <td><center>$contador</center></td>
                            <td>$a_o_del_hecho</td>
                            <td>$sexo_de_la_victima</td>
                            <td>$municipio_del_hecho</td>
                            <td>$contexto_de_violencia</td>
                          </tr>";
                      }
                  } else {
                      echo "
                      <tr>
                        <td colspan='5'>
                          <center>No se encontraron datos disponibles en el API.</center>
                        </td>
                      </tr>";
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th><center>#</center></th>
                    <th><center>Año del Hecho</center></th>
                    <th><center>Sexo de la Víctima</center></th>
                    <th><center>Municipio</center></th>
                    <th><center>Contexto de Violencia</center></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

<!-- // Se incluye el archivo donde se encuentra contenido y footer del sitio -->
<?php include('../layout/parte2.php'); ?>
<?php include('../layout/mensajes.php'); ?>

<!-- Script de los datatables -->
<script>
  $(function() {
    $("#example1").DataTable({
      /* cambio de idiomas de datatable */
      "pageLength": 5,
      language: {
        "emptyTable": "No hay información",
        "decimal": "",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Reportes",
        "infoEmpty": "Mostrando 0 a 0 de 0 Reportes",
        "infoFiltered": "(Filtrado de _MAX_ total Reportes)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Reportes",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscador:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
      /* fin de idiomas */
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      /* Ajuste de botones */
      buttons: [{
          extend: 'collection',
          text: 'Reportes',
          orientation: 'landscape',
          buttons: [{
            text: 'Copiar',
            extend: 'copy'
          }, {
            extend: 'pdf',
          }, {
            extend: 'csv',
          }, {
            extend: 'excel',
          }, {
            text: 'Imprimir',
            extend: 'print'
          }]
        },
        {
          extend: 'colvis',
          text: 'Visibilidad de columnas'
        }
      ],
      /*Fin de ajuste de botones*/
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
