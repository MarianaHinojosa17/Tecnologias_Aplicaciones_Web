<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>
<br><br>
<h1>Editar Maestro</h1>

<form method="post">
	
	<?php

	$editarMaestro = new MvcController();
	$editarMaestro -> editarMaestroController();
	$editarMaestro -> actualizarMaestroController();

	?>

</form>



