<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>
<br><br>

<h1>Editar Carrera</h1>

<form method="post">
	
	<?php

	$editarCarrera = new MvcController();
	$editarCarrera -> editarCarreraController();
	$editarCarrera -> actualizarCarreraController();

	?>

</form>



