<?php


/*
	SE MANDA LLAMAR EL ARCHIVO CONEXION
*/

require_once "conexion.php";

class Datos extends Conexion{



	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE CREA LA FUNCION EN LA CUAL MEDIANTE LA CONEXION SE SELECCION DE LA TABLA DE LOS USUARIOS, EL USER Y EL PASWORD QUE HAYA DADO EN EL ARRAY EL CONTROLADOR

		ESTA CONSULTA SE EJECUTA Y SE DEVUELVE
	*/

	public static function ingresoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT user_name, user_password_hash FROM $tabla WHERE user_name = :usuario");	
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();

	
		return $stmt->fetch();

		$stmt->close();

	}





	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE INSERTA EN LA TABLA DADA LOS VALORES QUE MANDO EL CONTROLADOR

		SI SE EJECUTA CORRECTAMENTE DEVUELVE COMO VALOR SUCCESS, SI NO, DEVUELVE UN ERROR
	*/
	
	public static function registroProdModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_producto,nombre_producto,date_added,precio_producto,stock,id_categoria) VALUES (:codigo_producto,:nombre_producto,:date_added,:precio_producto,:stock,:id_categoria)");	

		$stmt->bindParam(":codigo_producto", $datosModel["codigo_producto"]);	
		$stmt->bindParam(":nombre_producto", $datosModel["nombre_producto"]);	
		$stmt->bindParam(":date_added", $datosModel["fecha"]);	
		$stmt->bindParam(":precio_producto", $datosModel["precio_producto"]);	
		$stmt->bindParam(":stock", $datosModel["stock"]);	
		$stmt->bindParam(":id_categoria", $datosModel["categoria"]);		

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	/*
		LA FUNCION RECIBE COMO PARAMETRO EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE SELECCIONA LOS VALORES DE LA TABLA DADA

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA SIENDO ESTO TODOS LOS REGISTROS EXISTENTES EN LA TABLA DE LA BASE DE DATOS
	*/

	public static function vistaProdModel($tabla){

		

		$stmt = Conexion::conectar()->prepare("SELECT *,nombre_categoria as nomCate FROM $tabla inner join categorias on $tabla.id_categoria = categorias.id_categoria");	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}


/*
		LA FUNCION RECIBE COMO PARAMETRO EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE SELECCIONA LOS VALORES DE LA TABLA DADA

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA SIENDO ESTO TODOS LOS REGISTROS EXISTENTES EN LA TABLA DE LA BASE DE DATOS
	*/
	public static function vistaProdStockModel($tabla){

		

		$stmt = Conexion::conectar()->prepare("SELECT *,nombre_categoria as nomCate FROM $tabla inner join categorias on $tabla.id_categoria = categorias.id_categoria WHERE stock = 0");	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}


/*
		LA FUNCION RECIBE COMO PARAMETRO EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE SELECCIONA LOS VALORES DE LA TABLA DADA

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA SIENDO ESTO TODOS LOS REGISTROS EXISTENTES EN LA TABLA DE LA BASE DE DATOS

		AQUI SOLO SE TOMA EL VALO DE STOCK
	*/
	public static function consultaProdModel($tabla){

		

		$stmt = Conexion::conectar()->prepare("SELECT stock FROM $tabla WHERE id_producto = :id_producto");	

		$stmt->bindParam(":id_producto", $datosModel["producto"]);	

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}



/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE INSERTA EN LA TABLA DADA LOS VALORES QUE MANDO EL CONTROLADOR

		SI SE EJECUTA CORRECTAMENTE DEVUELVE COMO VALOR SUCCESS, SI NO, DEVUELVE UN ERROR
	*/

	public static function registroMovModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_producto,user_id,fecha,nota,referencia,cantidad) VALUES (:id_producto, :user_id,:fecha,:nota,:referencia,:cantidad)");	

		$stmt->bindParam(":id_producto", $datosModel["producto"]);	
		$stmt->bindParam(":user_id", $datosModel["usuario"]);	
		$stmt->bindParam(":fecha", $datosModel["fecha"]);	
		$stmt->bindParam(":nota", $datosModel["nota"]);	
		$stmt->bindParam(":referencia", $datosModel["referencia"]);	
		$stmt->bindParam(":cantidad", $datosModel["cantidad"]);		

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	/*
		MEDIANTE LOS DATOS QUE MANDA EL CONTROLADOR, SE ACTUALIZA EN LA TABLA DADA LOS DATOS Y SE DEVUELVE UNA RESPUESA, YA SEA  SUCCESS O UN ERROR
	*/

	public static function movProdModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel["producto"]);
		$stmt->bindParam(":stock", $datosModel["cant"]);
		

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


/*
		LA FUNCION RECIBE COMO PARAMETRO EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE SELECCIONA LOS VALORES DE LA TABLA DADA

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA SIENDO ESTO TODOS LOS REGISTROS EXISTENTES EN LA TABLA DE LA BASE DE DATOS
	*/

	public static function vistaMovModel($tabla){



		$stmt = Conexion::conectar()->prepare("SELECT *,products.nombre_producto as nomProd, users.user_name as nomUser FROM $tabla inner join products on $tabla.id_producto = products.id_producto inner join users on $tabla.user_id = users.user_id");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}


	
	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE CONSULTA LOS VALORES DE LA TABLA DADA, DONDE SE CONIDICIONA QUE COINCIDAN CON LOS VALORES DADOS

		REGRESA LA INFORMACION OBTENIDA DE LA CONSULTA
	*/

	public static function editarProdModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id_producto");
		$stmt->bindParam(":id_producto", $datosModel["id_producto"]);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	
	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE ACTUALIZA EN LA TABLA DADA, LOS VALORES QUE MANDO EL CONTROLADOR EN EL ARRAY

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/


	public static function actualizarProdModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo_producto = :codigo_producto, nombre_producto = :nombre_producto, date_added = :date_added, precio_producto = :precio_producto, stock = :stock, id_categoria = :id_categoria WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel["id_producto"]);
		$stmt->bindParam(":codigo_producto", $datosModel["codigo_producto"]);
		$stmt->bindParam(":nombre_producto", $datosModel["nombre_producto"]);
		$stmt->bindParam(":date_added", $datosModel["date_added"]);
		$stmt->bindParam(":precio_producto", $datosModel["precio_producto"]);
		$stmt->bindParam(":stock", $datosModel["stock"]);
		$stmt->bindParam(":id_categoria", $datosModel["id_categoria"]);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE MANDA ELIMINAR DE LA TABLA QUE SE DA COMO PARAMETRO LA FILA QUE TENGA EL ID DADO POR EL CONTROLADOR

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/


	public static function borrarProdModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");
		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);

		//echo $tabla;

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	/*
		LA FUNCION RECIBE COMO PARAMETRO EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE SELECCIONA LOS VALORES DE LA TABLA DADA

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA SIENDO ESTO TODOS LOS REGISTROS EXISTENTES EN LA TABLA DE LA BASE DE DATOS
	*/

	public static function vistaCateModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		$results = $stmt->fetchAll();

		return $results;


		$stmt->close();

	}


	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE INSERTA EN LA TABLA DADA LOS VALORES QUE MANDO EL CONTROLADOR

		SI SE EJECUTA CORRECTAMENTE DEVUELVE COMO VALOR SUCCESS, SI NO, DEVUELVE UN ERROR
	*/

	public function registroCateModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_categoria,descripcion_categoria,date_added) VALUES (:nombre_categoria,:descripcion, :fecha)");	


		$stmt->bindParam(":nombre_categoria", $datosModel["nombre_categoria"]);
		$stmt->bindParam(":fecha", $datosModel["fecha"]);	
		$stmt->bindParam(":descripcion", $datosModel["descripcion"]);	
				


		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}




	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE CONSULTA LOS VALORES DE LA TABLA DADA, DONDE SE CONIDICIONA QUE COINCIDAN CON LOS VALORES DADOS

		REGRESA LA INFORMACION OBTENIDA DE LA CONSULTA
	*/


	public static function editarCateModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoria = :id_categoria");
		$stmt->bindParam(":id_categoria", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}




	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE ACTUALIZA EN LA TABLA DADA, LOS VALORES QUE MANDO EL CONTROLADOR EN EL ARRAY

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/

	public static function actualizarCateModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria ,nombre_categoria = :nombre_categoria, descripcion_categoria = :descripcion, date_added = :fecha WHERE id_categoria = :id_categoria");

		$stmt->bindParam(":id_categoria", $datosModel["id_categoria"]);
		$stmt->bindParam(":nombre_categoria", $datosModel["nombre_categoria"]);
		$stmt->bindParam("descripcion", $datosModel["descripcion"]);
		$stmt->bindParam(":fecha", $datosModel["fecha"]);
		

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE MANDA ELIMINAR DE LA TABLA QUE SE DA COMO PARAMETRO LA FILA QUE TENGA EL ID DADO POR EL CONTROLADOR

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/

	public static function borrarProdCateModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_categoria = :id_categoria");
		$stmt->bindParam(":id_categoria", $datosModel, PDO::PARAM_INT);


		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	



	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE MANDA ELIMINAR DE LA TABLA QUE SE DA COMO PARAMETRO LA FILA QUE TENGA EL ID DADO POR EL CONTROLADOR

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/

	public static function borrarCateModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_categoria = :id_categoria");
		$stmt->bindParam(":id_categoria", $datosModel, PDO::PARAM_INT);

		//echo $tabla;

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}





	/*
		LA FUNCION RECIBE COMO PARAMETRO EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE SELECCIONA LOS VALORES DE LA TABLA DADA

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA SIENDO ESTO TODOS LOS REGISTROS EXISTENTES EN LA TABLA DE LA BASE DE DATOS
	*/

	public static function vistaUsuariosModel($tabla){

		
		//echo "hola";

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		$results = $stmt->fetchAll();


		return $results;


		$stmt->close();

	}



/*
		LA FUNCION RECIBE COMO PARAMETRO EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE SELECCIONA LOS VALORES DE LA TABLA DADA

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA SIENDO ESTO TODOS LOS REGISTROS EXISTENTES EN LA TABLA DE LA BASE DE DATOS
	*/

	public function vistaAlumnosModel2($tabla){

		


		$stmt = Conexion::conectar()->prepare("SELECT * from alumno");

		$stmt->execute();

		$results = $stmt->fetchAll();


		return $results;


		$stmt->close();

	}





	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE INSERTA EN LA TABLA DADA LOS VALORES QUE MANDO EL CONTROLADOR

		SI SE EJECUTA CORRECTAMENTE DEVUELVE COMO VALOR SUCCESS, SI NO, DEVUELVE UN ERROR
	*/

	public static function registroUsuarioModel($datosModel, $tabla){



		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (firstname,lastname,user_name,user_password_hash,user_email,date_added) VALUES (:firstname,:lastname,:user_name,:user_password_hash,:user_email,:date_added)");	


		$stmt->bindParam(":firstname", $datosModel["firstname"]);
		$stmt->bindParam(":lastname", $datosModel["lastname"]);	
		$stmt->bindParam(":user_name", $datosModel["user_name"]);	
		$stmt->bindParam(":user_password_hash", $datosModel["user_password_hash"]);		
		$stmt->bindParam(":user_email", $datosModel["user_email"]);	
		$stmt->bindParam(":date_added", $datosModel["date_added"]);		

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE CONSULTA LOS VALORES DE LA TABLA DADA, DONDE SE CONIDICIONA QUE COINCIDAN CON LOS VALORES DADOS

		REGRESA LA INFORMACION OBTENIDA DE LA CONSULTA
	*/

	public static function editarUsuarioModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE user_id = :id_usuario");
		$stmt->bindParam(":id_usuario", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE CONSULTA LOS VALORES DE LA TABLA DADA, DONDE SE CONIDICIONA QUE COINCIDAN CON LOS VALORES DADOS

		REGRESA LA INFORMACION OBTENIDA DE LA CONSULTA
	*/

	public static function editarUsuarioModel2($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT user_id FROM $tabla WHERE user_name = :user_name");
		$stmt->bindParam(":user_name", $datosModel);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}


/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE ACTUALIZA EN LA TABLA DADA, LOS VALORES QUE MANDO EL CONTROLADOR EN EL ARRAY

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/

	public function actualizarUsuarioModel($datosModel, $tabla){

		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET firstname = :firstname, lastname = :lastname, user_name = :user_name, user_password_hash = :user_password_hash, user_email = :user_email, date_added = :date_added WHERE user_id = :user_id");

		$stmt->bindParam(":user_id", $datosModel["user_id"]);
		$stmt->bindParam(":firstname", $datosModel["firstname"]);
		$stmt->bindParam(":lastname", $datosModel["lastname"]);
		$stmt->bindParam(":user_name", $datosModel["user_name"]);
		$stmt->bindParam(":user_password_hash", $datosModel["user_password_hash"]);
		$stmt->bindParam(":user_email", $datosModel["user_email"]);
		$stmt->bindParam(":date_added", $datosModel["date_added"]);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}




	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE MANDA ELIMINAR DE LA TABLA QUE SE DA COMO PARAMETRO LA FILA QUE TENGA EL ID DADO POR EL CONTROLADOR

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/

	public static function borrarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE user_id = :user_id");
		$stmt->bindParam(":user_id", $datosModel, PDO::PARAM_INT);


		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	

}



?>