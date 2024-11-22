<?php

// Se incluye el archivo de configuración donde se encuentran declaradas variables globales
include('../app/config.php');
// Se incluye el archivo de sesión donde se encuentran las variables de sesión existentes
include('../layout/sesion.php');
// Se incluye el archivo donde se encuentra contenido y los nav-bar del sitio
include('../layout/parte1.php');
// Se incluye el archivo listado de usuarios donde se encuentra la consulta para llamar a todos los usuarios
include('../app/controllers/categorias/listado_de_categorias.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de categorias
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button>
                    </h1>
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
                            <h3 class="card-title">Categorias</h3>
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
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombre de la categoria</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($categorias_datos as $categorias_dato) {
                                        $id_categoria = $categorias_dato['id_categoria'];
                                        $nombre_categoria = $categorias_dato['nombre_categoria']; ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1; ?></center>
                                            </td>
                                            <td><?php echo $categorias_dato['nombre_categoria']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-update<?php echo $id_categoria; ?>">
                                                            <i class="fa fa-pencil-alt"></i> Editar
                                                        </button>
                                                        <!-- Modal para actualizar la categoría -->
                                                        <div class="modal fade" id="modal-update<?php echo $id_categoria; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <!-- Encabezado del modal -->
                                                                    <div class="modal-header" style="background-color: #28a745;">
                                                                        <h4 class="modal-title">Actualizar categoría</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <!-- Cuerpo del modal con un formulario para ingresar el nuevo nombre de la categoría -->
                                                                    <div class="modal-body">
                                                                        <form action="">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre de la categoría</label>
                                                                                    <!-- Campo de entrada para modificar el nombre de la categoría -->
                                                                                    <input type="text" id="nombre_categoria<?php echo $id_categoria; ?>" value="<?php echo $nombre_categoria; ?>" class="form-control">
                                                                                    <small style="color: red; display:none " id="lbl_update<?php echo $id_categoria; ?>">Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- Pie de página del modal con botones para cancelar o actualizar -->
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                        <!-- Botón para activar la actualización -->
                                                                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_categoria; ?>">Actualizar</button>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin del contenido del modal -->
                                                            </div>
                                                            <!-- Fin del diálogo del modal -->
                                                        </div>

                                                        <!-- Script para manejar el clic en el botón de actualización dentro del modal -->
                                                        <script>
                                                            $('#btn_update<?php echo $id_categoria; ?>').click(function() {
                                                                // Obtiene el valor ingresado para el nombre de la categoría.
                                                                var nombre_categoria = $('#nombre_categoria<?php echo $id_categoria; ?>').val();
                                                                var id_categoria = '<?php echo $id_categoria; ?>';

                                                                if (nombre_categoria == "") {
                                                                    $('#nombre_categoria<?php echo $id_categoria; ?>').focus();
                                                                    $('#lbl_update<?php echo $id_categoria; ?>').css('display','block');
                                                                } else {
                                                                    // URL donde se envían los datos para actualizar la categoría.
                                                                    var url = "../app/controllers/categorias/update_de_categorias.php";

                                                                    // Se realiza una solicitud GET para actualizar los datos de la categoría.
                                                                    $.get(url, {
                                                                        nombre_categoria: nombre_categoria,
                                                                        id_categoria: id_categoria
                                                                    }, function(datos) {
                                                                        // Se actualiza el contenido del elemento con la respuesta recibida.
                                                                        $('#respuesta_update<?php echo $id_categoria; ?>').html(datos);
                                                                    });
                                                                }
                                                            });
                                                        </script>

                                                        <!-- Contenedor para mostrar la respuesta de la operación de actualización -->
                                                        <div id="respuesta_update<?php echo $id_categoria; ?>"></div>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombre de la categoria </center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorias",
                "infoEmpty": "Mostrando 0 a 0 de 0 Categorias",
                "infoFiltered": "(Filtrado de _MAX_ total Categorias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Categorias",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
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
                    text: 'Visor de columnas'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- Modal para registrar categorias -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff;">
                <h4 class="modal-title">Crear categorias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""> Nombre de la categoria </label>
                            <input type="text" id="nombre_categoria" class="form-control">
                            <small style="color: red; display:none " id="lbl_create">Este campo es requerido</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn-create" class="btn btn-primary">Crear</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    // Se agrega un evento al botón con el ID 'btn-create' que se activa cuando se hace clic.
    $('#btn-create').click(function() {
        // Se obtiene el valor ingresado en el campo de texto con el ID 'nombre_categoria'.
        var nombre_categoria = $('#nombre_categoria').val();

        if (nombre_categoria == "") {
            $('#nombre_categoria').focus();
            $('#lbl_create').css('display', 'block');
        } else {
            // Se define la URL a la que se enviará la solicitud para registrar una nueva categoría.
            var url = "../app/controllers/categorias/registro_de_categorias.php";

            // Se envía una solicitud GET a la URL especificada con el parámetro 'nombre_categoria'.
            $.get(url, {
                nombre_categoria: nombre_categoria
            }, function(datos) {
                // Cuando se recibe una respuesta del servidor, se inserta su contenido en el elemento con el ID 'respuesta'.
                $('#respuesta').html(datos);
            });
        }
    });
</script>

<div class="" id="respuesta"></div>