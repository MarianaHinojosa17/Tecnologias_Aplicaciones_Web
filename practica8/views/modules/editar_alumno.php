<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>
<br><br>
<h1>Editar Alumno</h1>
<br><br>

<form method="post">
	
	<?php

	$editarAlumno = new MvcController();
	$editarAlumno -> editarAlumnoController();
	$editarAlumno -> actualizarAlumnoController();

	?>

</form>



