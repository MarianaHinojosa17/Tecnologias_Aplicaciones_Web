<?php

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>


<center>
  <br><br>
<h1 >Detalles Tutoria</h1>
              <br>
              <br>
              <table border="1" style="font-family: Arial;">
                <thead>
                  <tr>
                    <th width="200">ID Tutoria</th>
                    <th width="250">Alumno</th>
                    <th width="250">Tutor</th>
                  </tr>
                </thead>
                <tbody>

                 <?php  

                 $vistaUsuario = new MvcController();
                 $vistaUsuario -> vistaDetTutoController();
					//$vistaUsuario -> borrarUsuarioController();

                 ?>
                </tbody>
              </table>
            <a href="index.php?action=tutorias"><button class="button" >Regresar</button></a>

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
