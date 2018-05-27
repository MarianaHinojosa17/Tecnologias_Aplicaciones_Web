
<?php

/*
  SE INICIA LA SESION PARA QUE EL USUARIO TENGA PERMITIDO INGRESAR A ESTA VISTA

  LA VISTA ES PARA "AGREGAR UN ALUMNO A UNA TUTORIA"

  SE CREA UN FORM CON METODO POST

  SE CREA UN OBJETO DE LA CLASE CONTROLLER Y SE MANDA LLAMAR LAS FUNCIONES DE:
  MOSTRAR ALTUTO
  AGREGAR ALTUTO REGISTRO MAESTROS (PARA REGISTRAR LOS DATOS QUE INGRESO EL USUARIO EN EL FORMULARIO)
*/

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>

<center>
<br><br>
<h1>Agregar Alumno a Tutoria </h1>
  <br><br>
  <form method="post">

    <?php  

      $tuto = new MvcController();
      $tuto ->mostrarAlTutoController();
      $tuto ->agregarAlTutoController();

    ?>
    

  </form>

</center>



<?php


?>
