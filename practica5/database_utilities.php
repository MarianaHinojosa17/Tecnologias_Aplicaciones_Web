<?php

	//Se manda llamar el archivo donde se tiene la informacion de la base de datos para la conexion
	require_once('database_credentials.php');

	//Se crea la conexion con la base de datos
	$con = new mysqli($servidor, $usuario, $pass, $bd);

	//Se crea la funcion que trae toda la informacion de todos los registros existentes en la tabla de los usuarios
	function run_query()
	{
		global $con;
		$sql = 'SELECT * FROM user';
		$resultados = $con->query($sql);
		if($resultados->num_rows)
			return $resultados;
		return false;

	}

	//Se crea la funcion que registra a los usuario, recibiendo como parametro el correo y la contraseña del usuario
	function register($correo,$password)
	{
		global $con;
		$sql = "INSERT INTO user (email,password) VALUES ('$correo','$password')";
		$con->query($sql);

	}

	//Se crea la funcion que busca los usuario por el id, tomando como parametro el id
	function search_id($id)
	{
		global $con;
		$sql = "SELECT * FROM user where id='$id'";
		$resultados = $con->query($sql);
		if($resultados->num_rows)
			return mysqli_fetch_assoc($resultados);
		return false;

	}

	//Se crea la funcion que actualiza o modifica los usuarios por el id, tomando como parametro el id
	function update($id,$email,$password)
	{
		global $con;
		$sql = "UPDATE user SET email = '$email', password='$password'where id='$id'";
		$con->query($sql);

	}


	//Se crea la funcion que elimina el registro de la table de los usuarios, tomando como parametro el id del usuario a eliminar
	function delete($id)
	{
		global $con;
		$sql = "DELETE FROM user WHERE id='$id'";
		$con->query($sql);
	}

	
?>