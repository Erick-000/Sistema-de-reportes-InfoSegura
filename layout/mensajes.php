<?php

if ( (isset($_SESSION['mensaje'])) && (isset($_SESSION['icono'])) ){
  
  //Si la variable 'mensaje' existe se almacena en la variable 'respuesta'
  $respuesta = $_SESSION['mensaje']; 
  $icono = $_SESSION['icono'];
  ?>
  <script>
    Swal.fire({
      icon: "<?php echo $icono; ?>",
      //Se imprime la variable respuesta para mostrar el mensaje de la variable 'mensaje'
      title: "<?php echo $respuesta;?>",
    });
  </script>
<?php
  unset($_SESSION['mensaje']);
  unset($_SESSION['icono']);
}
?>