<?php

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


<!--
<form method="post">
	
	<label>Nombre Carrera:</label>
	<input type="text"  name="nombre" required>
	<input type="submit" value="Enviar" name="guardar">

</form>-->

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
//$registro = new MvcController();
//se invoca la función registroUsuarioController de la clase MvcController:
//$registro = new vistaUsuariosController();
//$registro -> registroUsuarioController();

$registro = new MvcController();
$registro ->registroAlumnoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
