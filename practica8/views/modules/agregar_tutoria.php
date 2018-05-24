
<?php

session_start();

if(!$_SESSION["validar"]){

  header("location:index.php?action=ingresar");

  exit();

}

?>

<center>
<br><br>
<h1>Agregar Tutoria: </h1>
  <br><br>
  <form method="post">
  <label>Fecha: </label> 
  <input type="date"  name="fecha" required style="font-family: Arial; font-size: 15px;">
  <br><br>
  <label>Hora: </label>
    <input type="text"  name="hora" required style="font-family: Arial; font-size: 15px;">
    <br><br>
    <label>Tipo Tutoria:</label>
  <select name="tipo">
    <option>individual</option>
    <option>grupal</option>
  </select>
  <br><br>
  <label>Tema a Abordar: </label>
  <input type="text" name="tema_tutoria">
  <br><br>
  <label>Tutor Responsable: </label>
  <select>
    <?php  

    $tutor = new MvcController();
    $tutor -> MaestrosController();

    ?>
  </select>

  <?php  

      $tipo = $_POST["tipo"];
    
       echo $tipo;
    if($tipo == "individual")
    {

        echo'

          <select name="alumno">';

          $tutor -> CarrerasController();

        echo '</select>

        ';

    }

  ?>

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
