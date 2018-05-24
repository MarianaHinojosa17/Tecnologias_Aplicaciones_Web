<h1>REGISTRO DE PRODUCTOS by MR</h1>

<form method="post">
	
	<input type="text" placeholder="Product" name="productName" required>

	<input type="password" placeholder="Description" name="ProductDesription" required>
	<input type="password" placeholder="Buy price" name="ProductBuyPrice" required>
		<input type="password" placeholder="Sale price" name="ProductSalePrice" required>



	<input type="email" placeholder="Price" name="ProductPrice" required>

	<input type="submit" value="Enviar">

</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new MvcController();
//se invoca la función registroProductosController de la clase MvcController:
$registro -> registroProductosController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
