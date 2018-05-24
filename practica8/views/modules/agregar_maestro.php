<?php

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>


<center>
<br><br>
<h1 style="font-family: Arial; font-size: 40px;">Agregar Maestro</h1>
  <br><br>
  <form method="post"> 
  <label>Carrera:</label>
  <select name="carrera">
  	<?php 
  		$carreras = new MvcController();
  		$carreras -> CarrerasController();
  	?>
  </select>
  <br><br>
  <label>Nombre: </label>
  <input type="text"  name="nombre" required style="font-family: Arial; font-size: 15px;" placeholder="Nombre">
  <br><br>
  <label>Email: </label>
  <input type="text"  name="email" required style="font-family: Arial; font-size: 15px;" placeholder="Email">
  <br><br>
  <label>Password: </label>
  <input type="text"  name="pass" required style="font-family: Arial; font-size: 15px;" placeholder="Password">
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
$registro ->registroMaestrosController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
