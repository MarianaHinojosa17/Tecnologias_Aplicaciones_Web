<?php

	//Se requerira el archivo database_credentials.php para tener las credenciales de la base de datos
	require_once('database_credentials.php');

	//Se crea la conexion de base de datos usando PDO
	try
	{

		$PDO = new PDO(	$dsn, $user, $password);

	}
	catch(PDOException $e)
	{

		echo 'Error al conectarnos: ' . $e->getMessage();
	}


  //Funcion donde se valida si existe el usuario, dando como parametro el usuario y la contraseña
  function usuarioValid($usuario,$contra)
  {
    global $PDO;

    $contra = md5($contra);
    $sql = "SELECT * FROM usuario where usuario = '$usuario' AND password = '$contra'";
    $statement = $PDO->PREPARE($sql);
    $statement->EXECUTE();

    if($statement->rowCount() > 0)
    {
      return true;
    }
      return false;
  }


	//Funcion donde se inserta un nuevo usuario dando el usuario y la contraseña
	function agregarUsuario($usuario,$contra)
	{
		global $PDO;

		//Se encripta la contraseña ingresada por el usuario mediante el metodo md5
		$contra = md5($contra);
  		$sql = "INSERT INTO usuario (usuario,password) VALUES ('$usuario','$contra')";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}

  	

  	//Funcion donde se inserta un producto dando su nombre y el precio como parametro
	function agregarProd($nombre,$precio)
	{
		global $PDO;

  		$sql = "INSERT INTO producto (nombre,precio) VALUES ('$nombre','$precio')";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  	}




  	//Funcion donde se consulta la seleccion de toda la informacion de los usuarios registrados
  	function usuarios()
  	{
  		global $PDO;
		$sql = "SELECT * from usuario";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	//Funcion para eliminar un usuario por su id
  	function eliminarUsuario($id)
  	{
  		global $PDO;

  		$sql = "DELETE FROM usuario WHERE id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}


  	//Funcion donde se busca la informacion de un usuario en particular dando su id
	function buscarIdUsuario($id)
	{
		global $PDO;

		$sql = "SELECT * FROM usuario where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0];

	}

	//Funcion que actualiza los datos del usuario segun se hayan captado en el formulario
	function modificarUsuario($usuario,$id)
	{
		global $PDO;

  		$sql = "UPDATE usuario SET usuario = '$usuario' where id='$id'";

		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();

  	}


  	//Funcion que consulta toda la informacion de la tabla producto
  	function productos()
  	{
  		global $PDO;
		$sql = "SELECT * from producto";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	//Funcion en la cual se elimina un producto dando su id
  	function eliminarProd($id)
  	{
  		global $PDO;

  		$sql = "DELETE FROM producto WHERE id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
	}

	//Funcion donde se busca un producto en particular dando su id
	function buscarIdProd($id)
	{
		global $PDO;

		$sql = "SELECT * FROM producto where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0];

	}

	//Funcion donde se actualiza la informacion de cierto producto dando su id, el nombre y el precio modificados
	function modificarProd($id,$nombre,$precio)
	{
		global $PDO;

  		$sql = "UPDATE producto SET nombre = '$nombre', precio = '$precio' where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();

  	}

  	//Funcion donde se consulta toda la informacion de las ventas almacenadas
  	function ventas()
  	{
  		global $PDO;
  		$sql = "SELECT * FROM venta";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  		$results = $statement-> fetchAll();
  		return $results;
  	}


  	/*function detallesVenta()
  	{
  	}*/

  	/*function prodDispon()
  	{
  		global $PDO;
  		$sql = "SELECT * FROM"
  	}*/


  	//Funcion donde se inserta una venta, dando como parametro el monto total y la fcha en que se realizo
  	function agregarVenta($monto,$fecha)
  	{
  		global $PDO;
  		$sql = "INSERT INTO venta (monto,fecha) VALUES ('$monto','$fecha')";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  	}


  	//Funcion donde nos muestra el id de la ultima venta registrada
  	function ultimaVenta()
  	{
  		global $PDO;
  		$sql = "SELECT max(id) from venta";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  		$results = $statement->fetchAll();
  		return $results[0]['max(id)'];
  	}

  	//Funcion que nos devuelve el id de un producto dependiendo su nombre
  	function idProd($nombre)
  	{
  		global $PDO;
  		$sql = "SELECT id FROM producto WHERE nombre = '$nombre'";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  		$results = $statement->fetchAll();
  		return $results[0]['id'];
  	}

  	//Funcion donde se inserta el detalle de cada venta, dando como parametro el id de la venta, el id del producto, la cantidad de ese producto y el promedio de la prenda del producto.
  	function agregarDetVenta($id_venta,$id_producto,$cantidad,$prom_prenda)
  	{
  		global $PDO;
  		$sql = "INSERT INTO detalle_venta (id_venta,id_producto,cantidad,prom_prenda) values ('$id_venta','$id_producto','$cantidad','$prom_prenda') ";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  	}

  	//Funcion donde se crea una consulta que nos muestra los detalle de la venta, de la tabla detalle venta, la cual recibe como parametro el id de la venta y nos trae los productos que se encuentra en esa venta

  	function detalleVenta($id)
  	{
  		global $PDO;

  		$sql = "SELECT * from detalle_venta as dv inner join producto as p on dv.id_producto = p.id where id_venta = '$id'";
  		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}
		


?>