<?php


/*
	SE MANDA LLAMAR EL ARCHIVO CONEXION
*/

require_once "conexion.php";

class Datos extends Conexion{



	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE CREA LA FUNCION EN LA CUAL MEDIANTE LA CONEXION SE SELECCION DE LA TABLA MAESTROS, EL EMAIL Y EL PASWORD QUE HAYA DADO EN EL ARRAY EL CONTROLADOR

		ESTA CONSULTA SE EJECUTA Y SE DEVUELVE
	*/

	public function ingresoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT email, pass FROM $tabla WHERE email = :email");	
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->execute();

	
		return $stmt->fetch();

		$stmt->close();

	}



	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE INSERTA EN LA TABLA DADA LOS VALORES QUE MANDO EL CONTROLADOR

		SI SE EJECUTA CORRECTAMENTE DEVUELVE COMO VALOR SUCCESS, SI NO, DEVUELVE UN ERROR
	*/
	
	public function registroCarreraModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");	

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);		

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

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA 
	*/

	public function vistaCarrerasModel($tabla){

		

		$stmt = Conexion::conectar()->prepare("SELECT id_carrera,nombre FROM $tabla");	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}

	
	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		EN LA SIGUIENTE FUNCION SE CONSULTA LOS VALORES DE LA TABLA DADA, DONDE SE CONIDICIONA QUE COINCIDAN CON LOS VALORES DADOS

		REGRESA LA INFORMACION OBTENIDA DE LA CONSULTA
	*/

	public function editarCarreraModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_carrera, nombre FROM $tabla WHERE id_carrera = :id_carrera");
		$stmt->bindParam(":id_carrera", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	
	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE ACTUALIZA EN LA TABLA DADA, LOS VALORES QUE MANDO EL CONTROLADOR EN EL ARRAY

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/


	public function actualizarCarreraModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id_carrera = :id_carrera");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_carrera", $datosModel["id_carrera"]);

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


	public function borrarCarreraModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_carrera = :id_carrera");
		$stmt->bindParam(":id_carrera", $datosModel, PDO::PARAM_INT);

		echo $tabla;

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

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA 
	*/


	public function vistaMaestrosModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT *, carreras.nombre as carNom, $tabla.nombre, $tabla.email, $tabla.pass FROM $tabla inner join carreras on $tabla.id_carrera = carreras.id_carrera");

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

	public function registroMaestroModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_carrera,nombre,email,pass) VALUES (:carrera,:nombre,:email,:pass)");	


		$stmt->bindParam(":carrera", $datosModel["carrera"]);
		$stmt->bindParam(":nombre", $datosModel["nombre"]);	
		$stmt->bindParam(":email", $datosModel["email"]);	
		$stmt->bindParam(":pass", $datosModel["pass"]);			


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


	public function editarMaestroModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT *, carreras.nombre as carNom, $tabla.nombre, $tabla.email, $tabla.pass FROM $tabla inner join carreras on $tabla.id_carrera = carreras.id_carrera WHERE id_maestro = :id_maestro");
		$stmt->bindParam(":id_maestro", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}




	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE ACTUALIZA EN LA TABLA DADA, LOS VALORES QUE MANDO EL CONTROLADOR EN EL ARRAY

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/

	public function actualizarMaestroModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_carrera = :carrera, nombre = :nombre, email = :email, pass = :pass WHERE id_maestro = :id_maestro");

		$stmt->bindParam(":id_maestro", $datosModel["id_maestro"]);
		$stmt->bindParam(":nombre", $datosModel["nombre"]);
		$stmt->bindParam("carrera", $datosModel["carrera"]);
		$stmt->bindParam(":email", $datosModel["email"]);
		$stmt->bindParam(":pass", $datosModel["pass"]);

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

	public function borrarMaestroModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_maestro = :id_maestro");
		$stmt->bindParam(":id_maestro", $datosModel, PDO::PARAM_INT);

		echo $tabla;

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

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA 
	*/

	public function vistaAlumnosModel($tabla){

		


		$stmt = Conexion::conectar()->prepare("SELECT *, carreras.nombre as carNom, maestros.nombre as masNom, alumno.nombre as alumNom FROM $tabla inner join carreras on $tabla.id_carrera = carreras.id_carrera inner join maestros on $tabla.id_tutor = maestros.id_maestro");

		$stmt->execute();

		$results = $stmt->fetchAll();


		return $results;


		$stmt->close();

	}




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

	public function registroAlumnoModel($datosModel, $tabla){



		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula,nombre,id_carrera,id_tutor) VALUES (:matricula,:nombre,:carrera,:tutor)");	


		$stmt->bindParam(":matricula", $datosModel["matricula"]);
		$stmt->bindParam(":nombre", $datosModel["nombre"]);	
		$stmt->bindParam(":carrera", $datosModel["carrera"]);	
		$stmt->bindParam(":tutor", $datosModel["tutor"]);			

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	public function editarAlumnoModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT *, carreras.nombre as carNom, maestros.nombre as masNom, alumno.nombre as alumNom, $tabla.id_carrera as carAlum FROM $tabla inner join carreras on $tabla.id_carrera = carreras.id_carrera inner join maestros on $tabla.id_tutor = maestros.id_maestro WHERE id_alumno = :id_alumno");
		$stmt->bindParam(":id_alumno", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}



	/*
		LA FUNCION RECIBE COMO PARAMETRO LOS DATOS Y EL NOMBRE DE LA TABLA

		SE ACTUALIZA EN LA TABLA DADA, LOS VALORES QUE MANDO EL CONTROLADOR EN EL ARRAY

		SI SE REALIZO LA ACTUALIZACION CORRECTAMENTE, SE MANDA UN SUCCES, DE LO CONTRARIO SE MANDA UN ERROR
	*/

	public function actualizarAlumnoModel($datosModel, $tabla){

		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET matricula = :matricula, nombre = :nombre, id_carrera = :carrera, id_tutor = :tutor WHERE id_alumno = :id_alumno");

		$stmt->bindParam(":id_alumno", $datosModel["id_alumno"]);
		$stmt->bindParam(":matricula", $datosModel["matricula"]);
		$stmt->bindParam(":carrera", $datosModel["carrera"]);
		$stmt->bindParam(":nombre", $datosModel["nombre"]);
		$stmt->bindParam(":tutor", $datosModel["tutor"]);

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

	public function borrarAlumnoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_alumno = :id_alumno");
		$stmt->bindParam(":id_alumno", $datosModel, PDO::PARAM_INT);

		echo $tabla;

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

		SE RETORNA LA INFORMACION QUE SE TOME DE LA CONSULTA 
	*/

	public function vistaTutoriasModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");
		$stmt->execute();

		$results = $stmt->fetchAll();

		return $results;


		$stmt->close();

	}

	

	public function vistaDetTutoModel($tabla, $datosModel){

		
		$stmt = Conexion::conectar()->prepare("SELECT *, alumno.nombre as alumNom FROM $tabla inner join alumno on $tabla.id_alumno = alumno.id_alumno WHERE id_tutoria = :id_tutoria");


		$stmt->bindParam(":id_tutoria", $datosModel, PDO::PARAM_INT);

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

	public function registroTutoriaModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (fecha,hora,tipo,tema_tutoria,id_maestro) VALUES (:fecha,:hora,:tipo,:tema_tutoria,:id_maestro)");	


		$stmt->bindParam(":fecha", $datosModel["fecha"]);
		$stmt->bindParam(":hora", $datosModel["hora"]);	
		$stmt->bindParam(":tipo", $datosModel["tipo"]);	
		$stmt->bindParam(":tema_tutoria", $datosModel["tema_tutoria"]);
		$stmt->bindParam(":id_maestro", $datosModel["tutor"]);			


		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	public function agregarAlTutoModel($datosModel, $tabla){

		//echo "hola";

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_tutoria,id_alumno) VALUES (:id_tutoria,:id_alumno)");	


		$stmt->bindParam(":id_tutoria", $datosModel["id_tutoria"]);
		$stmt->bindParam(":id_alumno", $datosModel["id_alumno"]);			


		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}



	/*public function mostrarAlTutoModel($datosModel,$tabla){


		$stmt = Conexion::conectar()->prepare("SELECT tipo FROM $tabla WHERE id_tutoria = :id_tutoria");
		$stmt->bindParam(":id_tutoria", $datosModel["id"]);
		$stmt->execute();

		$results = $stmt->fetchAll();

		return $results;


		$stmt->close();

	}*/

}



?>