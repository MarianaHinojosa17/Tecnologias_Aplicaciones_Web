<?php

/*
  SE INICIA LA SESION PARA QUE EL USUARIO TENGA PERMITIDO INGRESAR A ESTA VISTA

  LA VISTA ES PARA "AGREGAR UN ALUMNO"

  SE CREA UN FORM CON METODO POST

  Y SE CREAN LOS ELEMENTOS NECESARIOS PARA EL FORMULARIO PARA AGREGAR UN ALUMNO

  SE CREA UN OBJETO DE LA CLASE CONTROLLER Y SE MANDA LLAMAR LAS FUNCIONES DEL CONTROLADOR:
  CARRERAS (PARA MOSTRAR TODAS LAS CARRERAS DISPONIBLES)
  MAESTROS (PARA MOSTRAR TODAS LOS MAESTROS DISPONIBLES)
  REGISTRO ALUMNOS (PARA REGISTRAR LOS DATOS QUE INGRESO EL USUARIO EN EL FORMULARIO)
*/

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>

<center>
<br><br>
<h1>Agregar Alumno</h1>
  <br><br>
  <form method="post">
  <label>Matricula: </label> 
  <input type="text"  name="matricula" required style="font-family: Arial; font-size: 15px;" placeholder="Matricula">
  <br><br>
  <label>Nombre: </label>
    <input type="text"  name="nombre" required style="font-family: Arial; font-size: 15px;" placeholder="Nombre"><br><br>
    <label>Carrera:</label>
  <select name="carrera">
  	<?php 
  		$carreras = new MvcController();
  		$carreras -> CarrerasController();
  	?>
  </select>
  <br><br>
  <label>Tutor: </label>
  <select name="tutor">
    <?php 
      $carreras -> MaestrosController();
    ?>
  </select>
  <br><br><br>
  <input type="submit" value="Guardar" name="guardar">

</form>

</center>



<?php

/*
  SE CREA UNA OBJETO DEL CONTROLADOR
  Y SE MANDA LLAMAR LA FUNCION REGISTRO ALUMNO
*/

$registro = new MvcController();
$registro ->registroAlumnoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
