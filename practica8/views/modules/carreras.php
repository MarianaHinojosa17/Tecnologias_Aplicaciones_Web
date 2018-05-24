<?php

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>


<center>
  <br><br>
<h1 >CARRERAS</h1>
              <br>
              <a href="index.php?action=agregar_carrera"><button class="button">Agregar Carrera</button></a>
              <br>
              <br>
              <table border="1" style="font-family: Arial;">
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Usuario</th>
                    <th width="250">Modificar</th>
                    <th width="250">Eliminar</th>
                  </tr>
                </thead>
                <tbody>

                 <?php  

                 	$vistaCarreras = new MvcController();
					        $vistaCarreras -> vistaCarrerasController();
					//$vistaUsuario -> borrarUsuarioController();

                 ?>
                </tbody>
              </table>
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

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
