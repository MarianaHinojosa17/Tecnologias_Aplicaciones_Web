<?php

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>


<center>
  <br><br>
<h1 >TUTORIAS</h1>
              <br>
              <a href="index.php?action=agregar_tutoria" ><button class="button">Agregar Tutoria</button></a>
              <br>
              <br>
              <table border="1" style="font-family: Arial;">
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Fecha</th>
                    <th width="250">Hora</th>
                    <th width="250">Tipo</th>
                    <th width="250">Tema</th>
                    <th width="250">Ver Detalles</th>
                  </tr>
                </thead>
                <tbody>

                 <?php  

                 	$vistaTutorias = new MvcController();
					        $vistaTutorias -> vistaTutoriasController();
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
