<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template</title>

	<style>

		h1{
			font-family: Arial;
			font-size: 40px;
		}
		label
		{
			position: center;
			text-align: center;
			font-family: Arial;
			font-size: 18px;
		}

		select{
			width: 100%;
			font-family: Arial;
			font-size: 17px;
		}

		nav{
			position:relative;
			margin:auto;
			width:100%;
			height:auto;
			background:#289696;
			font-family: Arial;
			font-size: 20px;
		}

		nav ul{
			position:relative;
			margin:auto;
			width:60%;
			text-align: center;
		}

		nav ul li{
			display:inline-block;
			width:19%;
			line-height: 50px;
			list-style: none;
		}

		nav ul li a{
			color:white;
			text-decoration: none;
		}

		section{
			position: center;
			margin: auto;
			width:700px;
		}

		section h1{
			position: center;
			margin: auto;
			padding:10px;
			text-align: center;
		}

		section form{
			position:center;
			margin:auto;
			width:400px;
		}

		section form input{
			display:inline-block;
			padding:10px;
			width:95%;
			margin:5px;
			font-family: Arial;
			font-size: 17px;
		}

		section form input[type="submit"]{
			position:center;
			margin:20px auto;
			background:#289696;
			color: white;
			font-family: Arial;
			font-size: 17px;

		}

		section form select{
			display:inline-block;
			padding:10px;
			width:95%;
			margin:5px;
			font-family: Arial;
			font-size: 17px;
		}

		.button
		{
			position:center;
			margin:20px auto;
			background: #289696;
			color: white;
			font-family: Arial;
			font-size: 17px;
		}


		table{
			position:center;
			width:100%;
			left:-10%;
			font-family: Arial;
			font-size: 17px;
		}

		table thead tr th{
			padding:10px;
		}

		table tbody tr td{
			padding:10px;
		}
	</style>

</head>

<body>

<?php include "modules/navegacion.php"; ?>


<section>

<?php 

$mvc = new MvcController();
$mvc -> enlacesPaginasController();

 ?>

</section>
	
</body>

</html>