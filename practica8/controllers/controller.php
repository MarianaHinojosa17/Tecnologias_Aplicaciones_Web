<?php

class MvcController{

	/* EN LA SIGUIENTE FUNCION SE MANDA LLAMAR EL TEMPLATE QUE CONTIENE EL DISEÑO
	*/

	public function pagina(){	
		
		include "views/template.php";
	
	}


	/*
		EN LA SIGUIENTE FUNCION SE TOMA LA ACCION QUE DESA EL USUARIO Y SE MANDA EJECUTAR LA FUNCION ENLACES PAGINAS DEL MODELO, DANDO COMO PARAMETRO EL VALOR QUE CONTENGA LA VARIABLE ENLACES
	*/
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



	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO PARA INICIAR SESION, SE GUARDA EN UN ARRAY Y SE DA COMO PARAMETRO PARA EJECUTAR LA FUNCION INGRESO USAURIO DEL MODELO, DEPENDIENDO LA RESPUESTA QUE REGRESE LA FUNCION SE CONDICIONA SI INICIA SESION O NO
	*/

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



	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LA CAJA DE TEXTO, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO CARRERA DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE CARRERAS, SI NO REGRESA AL INDEX
	*/
	public function registroCarrerasController(){




		if(isset($_POST["guardar"]))
		{

			if (isset($_POST["nombre"])) 
			{
				$datosController = array( "nombre"=>$_POST["nombre"]);
			}
			

			$respuesta = Datos::registroCarreraModel($datosController, "carreras");

		
			if($respuesta == "success"){

				header("location:index.php?action=carreras");

			}

			else{

				header("location:index.php");
			}

		}

	}



	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA CARRERAS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA CARRERA REGISTRADA
	*/

	public function vistaCarrerasController(){


		$respuesta = Datos::vistaCarrerasModel("carreras");

		

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_carrera"].'</td>
				<td>'.$item["nombre"].'</td>
				<td><a href="index.php?action=editar_carrera&id='.$item["id_carrera"].'"><button class="button">Modificar</button></a></td>
				<td><a href="index.php?action=borrar_carrera&idBorrar='.$item["id_carrera"].'"><button class="button" >Eliminar</button></a></td>
			</tr>';

		}

	}

	
	/*
		EN LA SIGUIENTE FUNCION, SE TRAE EL ID DE LA CARRERA QUE EL USUARIO DESEA MODIFICAR Y SE GUARDA EN UN ARRAY EL CUAL SE USA DESPUES COMO PARAMETRO PARA MANDAR EJECUTA UNA FUNCION DEL MODELO

		CON LA RESPUESTA QUE REGRESE LA FUNCION DEL MODELO SE IMPRIME LA VISTA CON LA RESPECTIVA INFORMACION DE LA CARRERA SELECCIONADA

	*/

	public function editarCarreraController(){


		$datosController = $_GET["id"];
		//echo $datosController;
		//PREGUNTAR POR QUE NO ME FUNCIONA EL HIDDEN
		$respuesta = Datos::editarCarreraModel($datosController, "carreras");

		echo'
			<br><br>
			<center>
			<label>ID Carrera:</label>
			<input type="text" value="'.$respuesta["id_carrera"].'" name="idEditar" readonly>
			<br><br>
			<label>Nombre Carrera:</label>
			 <input type="text" value="'.$respuesta["nombre"].'" name="carreraEditar" required>
			 <br><br><br>
			 <input type="submit" value="Modificar" name="modificar">
			 </center>';
	}

	
	/*
		TENIENDO LA VISTA CON LA INFORMACION RESPECTIVA, SE CREA UNA FUNCION QUE PERMITA TRAER LA INFORMACION MODIFICADA DE LA VISTA, SE GUARDA EN UN ARRAY, Y ESTE SE UTILIZA POSTERIORMENTE COMO PARAMETRO PARA EJECUTAR LA FUNCION DE ACTUALIZAR CARRERA DEL MODELO

		LA FUNCION DEL MODELO REGRESA UNA RESPUESTA, SI ES CORRECTA TE DIRECCIONA A LA VISTA, SI NO, TE MANDA UN ERROR
	*/

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

	

	/*
		EN LA SIGUIENTE FUNCION SE TOMA EL ID DE LA CARRERA QUE HAYA SELECCIONADO EL USUARIO PARA ELIMINAR, SE GUARDA ESE ID EN UN ARRAY EL CUAL SE USA COMO PARAMETRO PARA MANDAR LLAMAR LA FUNCION DEL MODELO BORRAR CARRERA

		LA FUNCION DEVUELVE UNA RESPUESTA Y ESTA SE CONDICIONA, SI ES SATISFACTORIA TE DEVUELVE A LA VISTA
	*/

	public function borrarCarreraController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarCarreraModel($datosController, "carreras");

			if($respuesta == "success"){

				header("location:index.php?action=carreras");
			
			}

		}

	}



	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA MAESTROS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA CARRERA REGISTRADA
	*/

	public function vistaMaestrosController(){


		$respuesta = Datos::vistaMaestrosModel("maestros");


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

	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LAS CAJAS DE TEXTO O SELECTS, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO MAESTRO DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE MAESTRO, SI NO REGRESA AL INDEX
	*/

	public function registroMaestrosController(){

		if(isset($_POST["guardar"]))
		{
			
				$datosController = array( "carrera"=>$_POST["carrera"],
										  "nombre"=>$_POST["nombre"],
										  "email"=>$_POST["email"],
										  "pass"=>$_POST["pass"]);
			
			$respuesta = Datos::registroMaestroModel($datosController, "maestros");

			if($respuesta == "success"){

				header("location:index.php?action=maestros");

			}

			else{

				header("location:index.php");
			}

		}

	}


	/*
		EN LA SIGUIENTE FUNCION, SE TRAE EL ID DEL MAESTRO QUE EL USUARIO DESEA MODIFICAR Y SE GUARDA EN UN ARRAY EL CUAL SE USA DESPUES COMO PARAMETRO PARA MANDAR A EJECUTAE UNA FUNCION DEL MODELO LLAMADA EDITAR MAESTRO

		CON LA RESPUESTA QUE REGRESE LA FUNCION DEL MODELO SE IMPRIME LOS ELEMENTOS DE LA VISTA CON LA RESPECTIVA INFORMACION DE LA CARRERA SELECCIONADA

		PARA MOSTRAR LA CARRERA EN LA QUE SE ENCUENTRA EL MAESTRO, SE UTILIZA UN CICLO EN EL CUAL SE VAN IMPRIMIENDO LAS CARRERAS REGISTRADAS EN LA BD, PERO CON LA CONDICION DE QUE SI ESA CARRERA QUE TIENE EL NUMERO DEL CICLO ES IGUAL A LA QUE SELECCIONO EL USUARIO SE QUEDE COMO PRIMERA, ESE DECIR, SELECCIONADA

	*/

	public function editarMaestroController(){

		$respuesta1 = Datos::vistaCarrerasModel("carreras");

		$datosController = $_GET["id"];

		$respuesta = Datos::editarMaestroModel($datosController, "maestros");

		echo'
			<br><br>
			<center>
			<label>ID Maestro:</label>
			<input type="text" value="'.$respuesta["id_maestro"].'" name="idEditar" readonly>
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

	/*
		TENIENDO LA VISTA CON LA INFORMACION RESPECTIVA DE LO SELECCIONAD, SE CREA UNA FUNCION QUE PERMITA TRAER LA INFORMACION MODIFICADA DE EN LOS ELEMENTOS DE LA VISTA, SE GUARDA EN UN ARRAY, Y ESTE SE UTILIZA POSTERIORMENTE COMO PARAMETRO PARA EJECUTAR LA FUNCION DE ACTUALIZAR CARRERA DEL MODELO

		LA FUNCION DEL MODELO REGRESA UNA RESPUESTA, SI ES CORRECTA TE DIRECCIONA A LA VISTA, SI NO, TE MANDA UN ERROR
	*/

	public function actualizarMaestroController(){


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

	/*
		EN LA SIGUIENTE FUNCION SE TOMA EL ID DEL MAESTRO QUE HAYA SELECCIONADO EL USUARIO PARA ELIMINAR, SE GUARDA ESE ID EN UN ARRAY EL CUAL SE USA COMO PARAMETRO PARA MANDAR LLAMAR LA FUNCION DEL MODELO BORRAR MAESTRO

		LA FUNCION DEVUELVE UNA RESPUESTA Y ESTA SE CONDICIONA, SI ES SATISFACTORIA TE DEVUELVE A LA VISTA
	*/

	public function borrarMaestroController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarMaestroModel($datosController, "maestros");

			if($respuesta == "success"){

				header("location:index.php?action=maestros");
			
			}

		}

	}

	/*
		EN LA SIGUIENTE FUNCION SE MANDA EJECUTAR EL MODELO DE VUSTA CARRERAS

		ESTE MODELO DEVUELVE UNA RESPUESTA, Y MEDIANTE ESA RESPUESTA SE MANDA IMPRIMIR UNA CAJA DE SELECCION CON TODAS LAS CARRERAS EXISTENTES EN LA BD
	*/

	public function CarrerasController(){


		$respuesta = Datos::vistaCarrerasModel("carreras");


		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_carrera"].'>'.$item["nombre"].'</option>';

		}

	}

	/*
		EN LA SIGUIENTE FUNCION SE MANDA EJECUTAR EL MODELO DE VUSTA CARRERAS

		ESTE MODELO DEVUELVE UNA RESPUESTA, Y MEDIANTE ESA RESPUESTA SE MANDA IMPRIMIR UNA CAJA DE SELECCION CON TODAS LOS MAESTROS EXISTENTES EN LA BD
	*/

	public function MaestrosController(){


		$respuesta = Datos::vistaMaestrosModel("maestros");

		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_maestro"].'>'.$item["nombre"].'</option>';

		}

	}





	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA ALUMNOS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA ALUMNO REGISTRADO
	*/

	public function vistaAlumnosController(){


		$respuesta = Datos::vistaAlumnosModel("alumno");

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
	

	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LA CAJA DE TEXTO Y EN LOS SELECT DE LA VISTA, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO CARRERA DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE CARRERAS, SI NO REGRESA AL INDEX
	*/

	public function registroAlumnoController(){

		if(isset($_POST["guardar"]))
		{
	
				$datosController = array( "matricula"=>$_POST["matricula"],
										  "nombre"=>$_POST["nombre"],
										  "carrera"=>$_POST["carrera"],
										  "tutor"=>$_POST["tutor"]);
			
			$respuesta = Datos::registroAlumnoModel($datosController, "alumno");


			if($respuesta == "success"){

				header("location:index.php?action=alumnos");

			}

			else{

				header("location:index.php");
			}

		}

	}

	/*
		EN LA SIGUIENTE FUNCION, SE TRAE EL ID DEL ALUMNO QUE EL USUARIO DESEA MODIFICAR Y SE GUARDA EN UN ARRAY EL CUAL SE USA DESPUES COMO PARAMETRO PARA MANDAR A EJECUTAE UNA FUNCION DEL MODELO LLAMADA EDITAR ALUMNO

		CON LA RESPUESTA QUE REGRESE LA FUNCION DEL MODELO SE IMPRIME LOS ELEMENTOS DE LA VISTA CON LA RESPECTIVA INFORMACION DEL ALUMNO SELECCIONADO

		PARA MOSTRAR LA CARRERA EN LA QUE SE ENCUENTRA EL ALUMNO, SE UTILIZA UN CICLO EN EL CUAL SE VAN IMPRIMIENDO LAS CARRERAS REGISTRADAS EN LA BD, PERO CON LA CONDICION DE QUE SI ESA CARRERA QUE TIENE EL NUMERO DEL CICLO ES IGUAL A LA QUE SELECCIONO EL USUARIO SE QUEDE COMO PRIMERA, ESE DECIR, SELECCIONADA

		SE REALIZA LO MISMO QUE CON LAS CARRERAS PARA MOSTRAR EL TUTOR CORRESPONDIENTE AL ALUMNO SELECCIONADO

	*/

	public function editarAlumnoController(){

		$respuesta1 = Datos::vistaCarrerasModel("carreras");

		$respuesta2 = Datos::vistaMaestrosModel("maestros");

		$datosController = $_GET["id"];

		$respuesta = Datos::editarAlumnoModel($datosController, "alumno");

		echo'
			<center>
			<label>ID Alumno: </label>
			<input type="text" value="'.$respuesta["id_alumno"].'" name="idEditar" readonly>
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

	/*
		TENIENDO LA VISTA CON LA INFORMACION RESPECTIVA DE LO SELECCIONADO, SE CREA UNA FUNCION QUE PERMITA TRAER LA INFORMACION MODIFICADA DE EN LOS ELEMENTOS DE LA VISTA, SE GUARDA EN UN ARRAY, Y ESTE SE UTILIZA POSTERIORMENTE COMO PARAMETRO PARA EJECUTAR LA FUNCION DE ACTUALIZAR ALUMNO DEL MODELO

		LA FUNCION DEL MODELO REGRESA UNA RESPUESTA, SI ES CORRECTA TE DIRECCIONA A LA VISTA, SI NO, TE MANDA UN ERROR
	*/

	public function actualizarAlumnoController(){


		if(isset($_POST["modificar"])){

			$datosController = array( "id_alumno"=>$_POST["idEditar"],
							          "matricula"=>$_POST["matricula"],
							          "carrera"=>$_POST["carrera"],
							      	  "nombre"=>$_POST["nombre"],
							      	  "tutor"=>$_POST["tutor"]);


			$respuesta = Datos::actualizarAlumnoModel($datosController,"alumno");

			if($respuesta == "success"){

				header("location:index.php?action=alumnos");

			}

			else{

				echo "error";

			}

		}
	
	}

/*
		EN LA SIGUIENTE FUNCION SE TOMA EL ID DEL ALUMNO QUE HAYA SELECCIONADO EL USUARIO PARA ELIMINAR, SE GUARDA ESE ID EN UN ARRAY EL CUAL SE USA COMO PARAMETRO PARA MANDAR LLAMAR LA FUNCION DEL MODELO BORRAR ALUMNO

		LA FUNCION DEVUELVE UNA RESPUESTA Y ESTA SE CONDICIONA, SI ES SATISFACTORIA TE DEVUELVE A LA VISTA
	*/

	public function borrarAlumnoController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarAlumnoModel($datosController, "alumno");

			if($respuesta == "success"){

				header("location:index.php?action=alumnos");
			
			}

		}

	}




	/*
		EN LA SIGUIENTE FUNCION SE TRAE EL ID DE LA TUTORIA QUE EL USUARIO HAYA SELECCIONADO PARA VER LOS DETALLE DE LA MISMA, SE GUARDA EL ID EN UN ARRAY EL CUAL POSTERIORMENTE SE USA COMO PARAMENTRO AL MANDAR LLAMAR LA FUNCION VISTA DETALLES TUTORIAS DEL MODELO

		LA FUNCION DEVUELVE UNA RESPUESTA, LA CUAL ES UN ARRAYA Y CON ESTE MEDIANTE UN CICLO SE IMPRIME LOS DATOS EN UNA TABLA DE LA TUTORIA SELECCIONADA
	*/

	public function vistaDetTutoController(){

		//echo "hola";

		$datosController = $_GET["id"];

		//echo $datosController;

		$respuesta5 = Datos::vistaDetTutoModel("tutoria_info",$datosController);

		//print_r($respuesta5);

		foreach($respuesta5 as $row => $item){
		echo'<tr>
				<td>'.$item["id_tutoria"].'</td>
				<td>'.$item["alumNom"].'</td>
			</tr>';

		}

	}


	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA TUTORIAS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA CARRERA REGISTRADA
	*/

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
				<td><a href="index.php?action=agregar_al_tuto&id='.$item["id_tutoria"].'"><button class="button" >Agregar Alumno</button></a></td>
			</tr>';

		}

	}



	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LA CAJA DE TEXTO Y EN LOS SELECT DE LA VISTA, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO CARRERA DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE CARRERAS, SI NO REGRESA AL INDEX
	*/

	public function registroTutoriaController(){

		//echo "hola";

		if(isset($_POST["guardar"]))
		{
	
				$datosController = array( "fecha"=>$_POST["fecha"],
										  "hora"=>$_POST["hora"],
										  "tipo"=>$_POST["tipo"],
										  "tema_tutoria"=>$_POST["tema_tutoria"],
										  "tutor"=>$_POST["tutor"]);

				//print_r($datosController);

			
			$respuesta = Datos::registroTutoriaModel($datosController, "tutoria");


			if($respuesta == "success"){

				header("location:index.php?action=tutorias");

			}

			else{

				header("location:index.php");
			}

		}

	}




	public function mostrarAlTutoController(){


		$datosController = $_GET["id"];

		$respuesta = Datos::vistaAlumnosModel2("alumno");

		

		
		echo '

			<center>

				<label>ID Tutoria: </label>
				<input type="text" value="'.$datosController["id"].'" name="idEditar" readonly>
				<br><br>
				<select name="alumno">';

					foreach($respuesta as $row => $item){

						echo '<option value='.$item["id_alumno"].'>'.$item["nombre"].'</option>';

					}

		echo '</select>
			   <br><br><br>
			   <input type="submit" value="Guardar" name="guardar">


			</center>


		';

	}

	public function agregarAlTutoController(){


		if(isset($_POST["guardar"]))
		{
	
				$datosController = array( "id_tutoria"=>$_POST["idEditar"],
										  "id_alumno"=>$_POST["alumno"]
										  );

			
			$respuesta5 = Datos::agregarAlTutoModel($datosController, "tutoria_info");


			if($respuesta == "success"){

				header("location:index.php?action=tutorias");

			}

			else{

				header("location:index.php");
			}

		}

	}

	public function reporteTutoriasController(){


		$respuesta = Datos::vistaTutoriasModel("tutoria");

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_tutoria"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["hora"].'</td>
				<td>'.$item["tipo"].'</td>
				<td>'.$item["tema_tutoria"].'</td>
			</tr>';

		}

	}

	public function reporteAlumnosController(){


		$respuesta = Datos::vistaAlumnosModel("alumno");

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_alumno"].'</td>
				<td>'.$item["matricula"].'</td>
				<td>'.$item["alumNom"].'</td>
				<td>'.$item["carNom"].'</td>
				<td>'.$item["masNom"].'</td>';

		}

	}



	public function reporteMaestrosController(){


		$respuesta = Datos::vistaMaestrosModel("maestros");


		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_maestro"].'</td>
				<td>'.$item["carNom"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["email"].'</td>
				<td>'.$item["pass"].'</td>
			</tr>';

		}

	}


	public function reporteCarrerasController(){


		$respuesta = Datos::vistaCarrerasModel("carreras");

		

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_carrera"].'</td>
				<td>'.$item["nombre"].'</td>
			</tr>';

		}

	}



}






////
?>