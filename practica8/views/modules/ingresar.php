<br><br>
<h1>INGRESAR</h1>
<br><br>
	<form method="post">
		
		<input type="text" placeholder="e m a i l" name="usuarioIngreso" required>
		<br><br>
		<input type="password" placeholder="p a s s w o r d" name="passwordIngreso" required>
		<br><br>
		<input type="submit" value="Enviar">

	</form>

<?php

$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

}

?>