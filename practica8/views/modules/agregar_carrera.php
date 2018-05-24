<?php

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>


<center>
<br><br>
<h1 style="font-family: Arial; font-size: 40px;">Agregar Carrera</h1>
  <br><br>
  <form method="post"> 
  <label style="font-family: Arial;">Nombre Carrera:</label>
  <input type="text"  name="nombre" required style="font-family: Arial; font-size: 15px;" placeholder="Carrera">
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
$registro ->registroCarrerasController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
