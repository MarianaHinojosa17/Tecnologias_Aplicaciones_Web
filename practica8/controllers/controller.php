<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}



	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( "email"=>$_POST["usuarioIngreso"], 
								      "pass"=>$_POST["passwordIngreso"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "maestros");
			//Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["email"] == $_POST["usuarioIngreso"] && $respuesta["pass"] == $_POST["passwordIngreso"]){

				session_start();

				$_SESSION["validar"] = true;

				header("location:index.php?action=tutorias");

			}

			else{

				header("location:index.php?action=fallo");

			}

		}	

	}



	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroCarrerasController(){

		if(isset($_POST["guardar"]))
		{
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):

			if (isset($_POST["nombre"])) 
			{
				$datosController = array( "nombre"=>$_POST["nombre"]);
			}
			

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = Datos::registroCarreraModel($datosController, "carreras");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=carreras");

			}

			else{

				header("location:index.php");
			}

		}

	}


	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaCarrerasController(){


		$respuesta = Datos::vistaCarrerasModel("carreras");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		//print_r($respuesta);

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_carrera"].'</td>
				<td>'.$item["nombre"].'</td>
				<td><a href="index.php?action=editar_carrera&id='.$item["id_carrera"].'"><button class="button">Modificar</button></a></td>
				<td><a href="index.php?action=borrar_carrera&idBorrar='.$item["id_carrera"].'"><button class="button" >Eliminar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarCarreraController(){


		$datosController = $_GET["id"];
		//echo $datosController;
		//PREGUNTAR POR QUE NO ME FUNCIONA EL HIDDEN
		$respuesta = Datos::editarCarreraModel($datosController, "carreras");

		echo'
			<br><br>
			<center>
			<label>ID Carrera:</label>
			<input type="text" value="'.$respuesta["id_carrera"].'" name="idEditar" >
			<br><br>
			<label>Nombre Carrera:</label>
			 <input type="text" value="'.$respuesta["nombre"].'" name="carreraEditar" required>
			 <br><br><br>
			 <input type="submit" value="Modificar" name="modificar">
			 </center>';
	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarCarreraController(){

		//if(isset($_POST))


		if(isset($_POST["modificar"])){

			$datosController = array( "id_carrera"=>$_POST["idEditar"],
							          "nombre"=>$_POST["carreraEditar"]);
			
			$respuesta = Datos::actualizarCarreraModel($datosController, "carreras");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_carrera");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarCarreraController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarCarreraModel($datosController, "carreras");

			if($respuesta == "success"){

				header("location:index.php?action=carreras");
			
			}

		}

	}

	public function vistaMaestrosController(){


		$respuesta = Datos::vistaMaestrosModel("maestros");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		//print_r($respuesta);

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_maestro"].'</td>
				<td>'.$item["carNom"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["email"].'</td>
				<td>'.$item["pass"].'</td>
				<td><a href="index.php?action=editar_maestro&id='.$item["id_maestro"].'"><button class="button" >Modificar</button></a></td>
				<td><a href="index.php?action=borrar_maestro&idBorrar='.$item["id_maestro"].'"><button class="button">Eliminar</button></a></td>
			</tr>';

		}

	}

	public function registroMaestrosController(){

		if(isset($_POST["guardar"]))
		{
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):

			
				$datosController = array( "carrera"=>$_POST["carrera"],
										  "nombre"=>$_POST["nombre"],
										  "email"=>$_POST["email"],
										  "pass"=>$_POST["pass"]);
			

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = Datos::registroMaestroModel($datosController, "maestros");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=maestros");

			}

			else{

				header("location:index.php");
			}

		}

	}

	public function editarMaestroController(){

		$respuesta1 = Datos::vistaCarrerasModel("carreras");

		$datosController = $_GET["id"];
		//echo $datosController;
		//PREGUNTAR POR QUE NO ME FUNCIONA EL HIDDEN
		$respuesta = Datos::editarMaestroModel($datosController, "maestros");

		echo'
			<br><br>
			<center>
			<label>ID Maestro:</label>
			<input type="text" value="'.$respuesta["id_maestro"].'" name="idEditar" >
			<br><br>
			<label>Carrera:</label>
			<select name="carrera">';
				foreach($respuesta1 as $row => $item){

					if ($item["id_carrera"] == $respuesta["id_carrera"]) {
						echo '<option value='.$item["id_carrera"].' selected>'.$item["nombre"].'</option>';
					}

				echo '<option value='.$item["id_carrera"].'>'.$item["nombre"].'</option>';

				}
		echo'</select>
			<br><br>
			<label>Nombre:</label>
			 <input type="text" value="'.$respuesta["nombre"].'" name="nombre" required>
			 <br><br>
			<label>Email:</label>
			 <input type="text" value="'.$respuesta["email"].'" name="email" required>
			 <br><br>
			<label>Password:</label>
			 <input type="text" value="'.$respuesta["pass"].'" name="pass" required>
			 <br><br><br>
			 <input type="submit" value="Modificar" name="modificar">
			 </center>';

	}

	public function actualizarMaestroController(){

		//if(isset($_POST))

		//echo"hola";

		if(isset($_POST["modificar"])){

			$datosController = array( "id_maestro"=>$_POST["idEditar"],
							          "carrera"=>$_POST["carrera"],
							      	  "nombre"=>$_POST["nombre"],
							      	  "email"=>$_POST["email"],
							      	  "pass"=>$_POST["pass"]);
			
			$respuesta = Datos::actualizarMaestroModel($datosController, "maestros");

			if($respuesta == "success"){

				header("location:index.php?action=maestros");

			}

			else{

				echo "error";

			}

		}
	
	}

	public function borrarMaestroController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarMaestroModel($datosController, "maestros");

			if($respuesta == "success"){

				header("location:index.php?action=maestros");
			
			}

		}

	}

	public function CarrerasController(){


		$respuesta = Datos::vistaCarrerasModel("carreras");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		//print_r($respuesta);

		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_carrera"].'>'.$item["nombre"].'</option>';

		}

	}

	public function MaestrosController(){


		$respuesta = Datos::vistaMaestrosModel("maestros");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		//print_r($respuesta);

		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_maestro"].'>'.$item["nombre"].'</option>';

		}

	}



	public function vistaAlumnosController(){


		$respuesta = Datos::vistaAlumnosModel("alumno");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		//print_r($respuesta);

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_alumno"].'</td>
				<td>'.$item["matricula"].'</td>
				<td>'.$item["alumNom"].'</td>
				<td>'.$item["carNom"].'</td>
				<td>'.$item["masNom"].'</td>
				<td><a href="index.php?action=editar_alumno&id='.$item["id_alumno"].'"><button class="button" >Modificar</button></a></td>
				<td><a href="index.php?action=borrar_alumno&idBorrar='.$item["id_alumno"].'"><button class="button" >Eliminar</button></a></td>
			</tr>';

		}

	}

	public function registroAlumnoController(){

		if(isset($_POST["guardar"]))
		{
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):

			
				$datosController = array( "matricula"=>$_POST["matricula"],
										  "nombre"=>$_POST["nombre"],
										  "carrera"=>$_POST["carrera"],
										  "tutor"=>$_POST["tutor"]);
			

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = Datos::registroAlumnoModel($datosController, "alumno");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=alumnos");

			}

			else{

				header("location:index.php");
			}

		}

	}

	public function editarAlumnoController(){

		$respuesta1 = Datos::vistaCarrerasModel("carreras");

		$respuesta2 = Datos::vistaMaestrosModel("maestros");

		$datosController = $_GET["id"];

		//echo "hola";
		//echo $datosController;
		//PREGUNTAR POR QUE NO ME FUNCIONA EL HIDDEN
		$respuesta = Datos::editarAlumnoModel($datosController, "alumno");

		echo'
			<center>
			<label>ID Alumno: </label>
			<input type="text" value="'.$respuesta["id_alumno"].'" name="idEditar" >
			<br><br>
			<label>Matricula: </label>
			<input type="text" value="'.$respuesta["matricula"].'" name="matricula" required>
			<br><br>
			<label>Carrera: </label>
			<select name="carrera">';
				foreach($respuesta1 as $row => $item){

					if ($item["id_carrera"] == $respuesta["carAlum"]) {
						echo '<option value='.$item["id_carrera"].' selected>'.$item["nombre"].'</option>';
					}

				echo '<option value='.$item["id_carrera"].'>'.$item["nombre"].'</option>';

				}
		echo'</select>
			<br><br>
			<label>Nombre: </label>
			 <input type="text" value="'.$respuesta["alumNom"].'" name="nombre" required>
			 <br><br>
			<label>Tutor: </label>
			 <select name="tutor">';

			 foreach($respuesta2 as $row => $item){

					if ($item["id_maestro"] == $respuesta["id_maestro"]) {
						echo '<option value='.$item["id_maestro"].' selected>'.$item["nombre"].'</option>';
					}

				echo '<option value='.$item["id_maestro"].'>'.$item["nombre"].'</option>';

				}

		echo'


			</select>

			<br><br><br>

			 <input type="submit" value="Modificar" name="modificar">

			 </center>';

	}

	public function actualizarAlumnoController(){

		//if(isset($_POST))

		//echo"hola";

		//echo "hola";

		if(isset($_POST["modificar"])){

			$datosController = array( "id_alumno"=>$_POST["idEditar"],
							          "matricula"=>$_POST["matricula"],
							          "carrera"=>$_POST["carrera"],
							      	  "nombre"=>$_POST["nombre"],
							      	  "tutor"=>$_POST["tutor"]);


			//print_r($datosController);
			$respuesta = Datos::actualizarAlumnoModel($datosController,"alumno");

			if($respuesta == "success"){

				header("location:index.php?action=alumnos");

			}

			else{

				echo "error";

			}

		}
	
	}

	public function borrarAlumnoController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarAlumnoModel($datosController, "alumno");

			if($respuesta == "success"){

				header("location:index.php?action=alumnos");
			
			}

		}

	}


	public function vistaDetTutoController(){

		$datosController = $_GET["id"];

		$respuesta = Datos::vistaDetTutoModel("tutoria_info",$datosController);

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_tutoria"].'</td>
				<td>'.$item["alumNom"].'</td>
				<td>'.$item["masNom"].'</td>
			</tr>';

		}

	}


	public function vistaTutoriasController(){


		$respuesta = Datos::vistaTutoriasModel("tutoria");

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_tutoria"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["hora"].'</td>
				<td>'.$item["tipo"].'</td>
				<td>'.$item["tema_tutoria"].'</td>
				<td><a href="index.php?action=detalles_tuto&id='.$item["id_tutoria"].'"><button class="button" >Ver Detalles</button></a></td>
			</tr>';

		}

	}



	#ACTUALIZAR USUARIO
	#------------------------------------
	/*public function actualizarCarreraController(){

		//if(isset($_POST))


		if(isset($_POST["modificar"])){

			$datosController = array( "id_carrera"=>$_POST["idEditar"],
							          "nombre"=>$_POST["carreraEditar"]);
			
			$respuesta = Datos::actualizarCarreraModel($datosController, "carreras");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_carrera");

			}

			else{

				echo "error";

			}

		}
	
	}*/

}






////
?>