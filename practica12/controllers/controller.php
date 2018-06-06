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

		if(isset($_POST["ingresar"])){

			$datosController = array( "usuario"=>$_POST["usuario"], 
								      "pass"=>$_POST["pass"]);


			$respuesta = Datos::ingresoUsuarioModel($datosController, "users");

			if($respuesta["user_name"] == $datosController["usuario"] && $respuesta["user_password_hash"] == $datosController["pass"])
			{


				session_start();	


				$_SESSION["validar"] = true;

				$_SESSION["user"] = $datosController["usuario"];


				echo "<script>window.location='index.php?action=dashboard';</script>";


			}

			else{

				echo "<script>window.location='index.php';</script>";

			}

		}	

	}


 /*
 	EN LA SIGUIENTE FUNCION SE MANDA LLAMAR LA FUNCION VISTA DEL USUARIOS MODELO PARA QUE MANDE TODO LO CONSULTADO Y PODAMOS IMPRIMIR EL TAMAÑO DEL ARRAY QUE RETORNA LA FUNCION DEL MODELO
 	ESTO SE PUEDE VER EN LOS CUADROS DE COLORES DEL DASHBOARD, DONDE CONTIENE LOS TOTALES
 */

	public function usuariosContController()
	{
		$respuesta = Datos::vistaUsuariosModel("users");


		echo '<h3>'.sizeof($respuesta).'</h3>';

		
	}	

/*
 	EN LA SIGUIENTE FUNCION SE MANDA LLAMAR LA FUNCION VISTA PRODUCTOS MODELO PARA QUE MANDE TODO LO CONSULTADO Y PODAMOS IMPRIMIR EL TAMAÑO DEL ARRAY QUE RETORNA LA FUNCION DEL MODELO
 	ESTO SE PUEDE VER EN LOS CUADROS DE COLORES DEL DASHBOARD, DONDE CONTIENE LOS TOTALES
 */

	public function prodContController()
	{
		$respuesta = Datos::vistaProdModel("products");

		echo '<h3>'.sizeof($respuesta).'</h3>';

		
	}

	/*
 	EN LA SIGUIENTE FUNCION SE MANDA LLAMAR LA FUNCION VISTA MOVIMIENTOS MODELO PARA QUE MANDE TODO LO CONSULTADO Y PODAMOS IMPRIMIR EL TAMAÑO DEL ARRAY QUE RETORNA LA FUNCION DEL MODELO
 	ESTO SE PUEDE VER EN LOS CUADROS DE COLORES DEL DASHBOARD, DONDE CONTIENE LOS TOTALES
 */

	public function movimientosContController()
	{
		$respuesta = Datos::vistaMovModel("historial");

		echo '<h3>'.sizeof($respuesta).'</h3>';

		
	}

	/*
 	EN LA SIGUIENTE FUNCION SE MANDA LLAMAR LA FUNCION VISTA CATEGORIAS MODELO PARA QUE MANDE TODO LO CONSULTADO Y PODAMOS IMPRIMIR EL TAMAÑO DEL ARRAY QUE RETORNA LA FUNCION DEL MODELO
 	ESTO SE PUEDE VER EN LOS CUADROS DE COLORES DEL DASHBOARD, DONDE CONTIENE LOS TOTALES
 */

	public function cateContController()
	{
		$respuesta = Datos::vistaCateModel("categorias");

		echo '<h3>'.sizeof($respuesta).'</h3>';

	}



	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LA CAJA DE TEXTO, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO DE UN PRODUCTO DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE PRODUCTOS, SI NO REGRESA AL INDEX
	*/
	public function registroProdController(){



		if(isset($_POST["guardar"]))
		{
			//echo "hola";


			$datosController = array( "codigo_producto"=>$_POST["codigo_producto"],
										  "nombre_producto"=>$_POST["nombre_producto"],
										  "fecha"=>$_POST["fecha"],
										  "precio_producto"=>$_POST["precio_producto"],
										  "stock"=>$_POST["stock"],
											"categoria"=>$_POST["categoria"]);
			

			$respuesta = Datos::registroProdModel($datosController, "products");

			if($respuesta == "success"){

				echo "<script>window.location='index.php?action=productos';</script>";

			}

			else{

				echo "<script>window.location='index.php?action=agregar_prod';</script>";
			}

			

			
		}

	}



	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA PRODUCTOS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA PRODUCTO REGISTRADO
	*/

	public function vistaProdController(){


		$respuesta = Datos::vistaProdModel("products");

		

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_producto"].'</td>
				<td>'.$item["codigo_producto"].'</td>
				<td>'.$item["nombre_producto"].'</td>
				<td>'.$item["date_added"].'</td>
				<td>'.$item["precio_producto"].'</td>
				<td>'.$item["stock"].'</td>
				<td>'.$item["nomCate"].'</td> 
				<td><a href="index.php?action=editar_prod&id='.$item["id_producto"].'"><button class="btn btn-block btn-primary btn-sm">Modificar</button></a></td>
				<td><a href="index.php?action=borrar_prod&idBorrar='.$item["id_producto"].'"><button class="btn btn-block btn-danger btn-sm" >Eliminar</button></a></td>
			</tr>';

		}

	}


/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA PRODUCTOS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA PRODUCTO REGISTRADO QUE TENGA UNA CANTIDAD DE 0 EN EL STOCK

		ESTA TABLA SE PUEDE APRECIAR EN EL DASHBOARD
	*/

	public function vistaProdStockController(){

		

		$respuesta = Datos::vistaProdStockModel("products");

		

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_producto"].'</td>
				<td>'.$item["codigo_producto"].'</td>
				<td>'.$item["nombre_producto"].'</td>
				<td>'.$item["stock"].'</td>
				<td>'.$item["precio_producto"].'</td>
				<td>'.$item["nomCate"].'</td> 
			</tr>';

		}

	}

	
	/*
		EN LA SIGUIENTE FUNCION, SE TRAE EL ID DEL PRODUCTO QUE EL USUARIO DESEA MODIFICAR Y SE GUARDA EN UN ARRAY EL CUAL SE USA DESPUES COMO PARAMETRO PARA MANDAR EJECUTA UNA FUNCION DEL MODELO QUE TRAE LAS CATEGORIAS EXISTENTE, PARA PODER DEJAR SELECCIONADO LA CATEGORIA A LA QUE PERTENECE EL PRODUCTO

		LUEGO SE MANDA LLAMAR LA FUNCION DE EDITAR PRODUCTO DEL MODELO

		CON LA RESPUESTA QUE REGRESE LA FUNCION DEL MODELO SE IMPRIME LA VISTA CON LA RESPECTIVA INFORMACION DEL PRODUCTO SELECCIONADO

	*/

	public function editarProdController(){


		$datosController = $_GET["id"];

		$respuesta1 = Datos::vistaCateModel("categorias");

		$respuesta = Datos::editarProdModel($datosController, "products");

		echo'
			

				  <div class="form-group">
                    <label for="id_producto">ID Producto</label>
                    <input type="text" class="form-control" placeholder="" name="id_producto" value="'.$respuesta["id_producto"].'" readonly>
                  </div>

				  <div class="form-group">
                    <label for="codigo_producto">Codigo</label>
                    <input type="text" class="form-control" placeholder="" name="codigo_producto" value="'.$respuesta["codigo_producto"].'">
                  </div>

                  <div class="form-group">
                    <label for="nombre_producto">Nombre</label>
                    <input type="text" class="form-control"  placeholder="" name="nombre_producto" value="'.$respuesta["nombre_producto"].'">
                  </div>

                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control"  placeholder="" name="fecha" value="'.$respuesta["date_added"].'">
                  </div>

                  <div class="form-group">
                    <label for="precio_producto">Precio</label>
                    <input type="money" class="form-control"  placeholder="" name="precio_producto" value="'.$respuesta["precio_producto"].'">
                  </div>

                  <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control"  placeholder="" name="stock"value="'.$respuesta["stock"].'">
                  </div>

                  <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <br>
                    <select name="categoria" style="width: 708px;" class="form-control select2 select2-hidden-accessible">';


					foreach($respuesta1 as $row => $item){

						if ($item["id_categoria"] == $respuesta["id_categoria"]) {
						echo '<option value='.$item["id_categoria"].' selected>'.$item["nombre_categoria"].'</option>';
					}
					else
					{
						echo '<option value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';
					}

				

				}
                      


                   echo '</select>
                  </div>

  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger" style="width: 150px;" name="modificar">Modificar</button>
                </div>





			';
	}

	
	/*
		TENIENDO LA VISTA CON LA INFORMACION RESPECTIVA, SE CREA UNA FUNCION QUE PERMITA TRAER LA INFORMACION MODIFICADA DE LA VISTA, SE GUARDA EN UN ARRAY, Y ESTE SE UTILIZA POSTERIORMENTE COMO PARAMETRO PARA EJECUTAR LA FUNCION DE ACTUALIZAR PRODUCTO DEL MODELO

		LA FUNCION DEL MODELO REGRESA UNA RESPUESTA, SI ES CORRECTA TE DIRECCIONA A LA VISTA, SI NO, TE MANDA UN ERROR
	*/

	public function actualizarProdController(){

		//if(isset($_POST))


		if(isset($_POST["modificar"])){

			$datosController = array( "id_producto"=>$_POST["id_producto"],
										"codigo_producto"=>$_POST["codigo_producto"],
										"nombre_producto"=>$_POST["nombre_producto"],
										"date_added"=>$_POST["fecha"],
										"precio_producto"=>$_POST["precio_producto"],
										"stock"=>$_POST["stock"],
							          "id_categoria"=>$_POST["categoria"]);
			
			$respuesta = Datos::actualizarProdModel($datosController, "products");

			if($respuesta == "success"){

				//header("location:index.php?action=productos");

				echo "<script>window.location='index.php?action=productos';</script>";

			}

			else{

				echo "error";

			}

		}
	
	}

	

	/*
		EN LA SIGUIENTE FUNCION SE TOMA EL ID DEL PRODUCTO QUE HAYA SELECCIONADO EL USUARIO PARA ELIMINAR, SE GUARDA ESE ID EN UN ARRAY EL CUAL SE USA COMO PARAMETRO PARA MANDAR LLAMAR LA FUNCION DEL MODELO BORRAR PRODUCTO

		LA FUNCION DEVUELVE UNA RESPUESTA Y ESTA SE CONDICIONA, SI ES SATISFACTORIA TE DEVUELVE A LA VISTA
	*/

	public function borrarProdController(){


		if(isset($_GET["id"])){

			$datosController = $_GET["id"];

			$datosController2 = array( "usuario"=>$_SESSION["user"],
									  "pass"=>$_GET["contra"]);
	

			$respuesta3 = Datos::ingresoUsuarioModel($datosController2,"users");


			if($respuesta3["user_password_hash"] == $datosController2["pass"])
			{
				$respuesta = Datos::borrarProdModel($datosController, "products");



				if($respuesta == "success"){

					echo "<script>window.location='index.php?action=productos';</script>";
				
				}
			}
			else
			{
				
				echo "<script>alert('ERROR- CONTRASEÑA INCORRECTA')</script>";
			}

		}

	}



	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA CATEGORIAS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA CATEGORIA REGISTRADA
	*/

	public function vistaCateController(){


		$respuesta = Datos::vistaCateModel("categorias");


		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_categoria"].'</td>
				<td>'.$item["nombre_categoria"].'</td>
				<td>'.$item["descripcion_categoria"].'</td>
				<td>'.$item["date_added"].'</td>
				<td><a href="index.php?action=editar_categoria&id='.$item["id_categoria"].'"><button class="btn btn-block btn-primary btn-sm" >Modificar</button></a></td>
				<td><a href="index.php?action=borrar_categoria&idBorrar='.$item["id_categoria"].'"><button class="btn btn-block btn-danger btn-sm">Eliminar</button></a></td>
			</tr>';

		}

	}

	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LA CAJA DE TEXTO, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO DE UNA CATEGORIA DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE CATEGORIAS, SI NO REGRESA AL INDEX
	*/

	public function registroCateController(){

		if(isset($_POST["guardar"]))
		{
			
				$datosController = array( "nombre_categoria"=>$_POST["nombre_categoria"],
										  "fecha"=>$_POST["fecha"],
										  "descripcion"=>$_POST["descripcion"]);
			
			$respuesta = Datos::registroCateModel($datosController, "categorias");

			if($respuesta == "success"){

				//header("location:index.php?action=categorias");
				echo "<script>window.location='index.php?action=categorias';</script>";

			}

			else{

				//header("location:index.php?action=agregar_categoria");
				echo "<script>window.location='index.php?action=agregar_categoria';</script>";
			}

		}

	}


	/*
		EN LA SIGUIENTE FUNCION, SE TRAE EL ID DE LA CATEGORIA QUE EL USUARIO DESEA MODIFICAR Y SE GUARDA EN UN ARRAY EL CUAL SE USA DESPUES COMO PARAMETRO PARA MANDAR EJECUTA UNA FUNCION DEL MODELO

		CON LA RESPUESTA QUE REGRESE LA FUNCION DEL MODELO SE IMPRIME LA VISTA CON LA RESPECTIVA INFORMACION DE LA CATEGORIA SELECCIONADA

	*/

	public function editarCateController(){


		$datosController = $_GET["id"];

		$respuesta = Datos::editarCateModel($datosController, "categorias");


		echo '

				<div class="form-group" >
                    <label for="id_categoria">Nombre Categoria</label>
                    <input type="text" class="form-control" placeholder="" name="id_categoria" value="'.$respuesta["id_categoria"].'">
                  </div>

				<div class="form-group" >
                    <label for="nombre_categoria">Nombre Categoria</label>
                    <input type="text" class="form-control" id="nombre_categoria" placeholder="" name="nombre_categoria" value="'.$respuesta["nombre_categoria"].'">
                  </div>

                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control"  placeholder="" name="fecha" value="'.$respuesta["date_added"].'">
                  </div>

                  <div class="form-group">
                    <label for="fecha">Descripcion</label>
                    <textarea class="form-control" rows="3" placeholder="" name="descripcion">'.$respuesta["descripcion_categoria"].'</textarea>
                  </div>
  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger" style="width: 150px;" name="modificar">Modificar</button>

                </div>

            </div>




		';

	}

	/*
		TENIENDO LA VISTA CON LA INFORMACION RESPECTIVA DE LO SELECCIONAD, SE CREA UNA FUNCION QUE PERMITA TRAER LA INFORMACION MODIFICADA DE EN LOS ELEMENTOS DE LA VISTA, SE GUARDA EN UN ARRAY, Y ESTE SE UTILIZA POSTERIORMENTE COMO PARAMETRO PARA EJECUTAR LA FUNCION DE ACTUALIZAR CATEGORIA DEL MODELO

		LA FUNCION DEL MODELO REGRESA UNA RESPUESTA, SI ES CORRECTA TE DIRECCIONA A LA VISTA, SI NO, TE MANDA UN ERROR
	*/

	public function actualizarCateController(){

		//echo "hola";

		if(isset($_POST["modificar"])){

			$datosController = array( "id_categoria"=>$_POST["id_categoria"],
									  "nombre_categoria"=>$_POST["nombre_categoria"],
							          "fecha"=>$_POST["fecha"],
							      	  "descripcion"=>$_POST["descripcion"]);
			
			$respuesta = Datos::actualizarCateModel($datosController, "categorias");


			if($respuesta == "success"){

				echo "<script>window.location='index.php?action=categorias';</script>";

			}

			else{

				echo "<script>window.location='index.php?action=editar_categoria';</script>";

			}

		}
	
	}

	/*
		EN LA SIGUIENTE FUNCION SE TOMA EL ID DE LA CATEGORIA QUE HAYA SELECCIONADO EL USUARIO PARA ELIMINAR, SE GUARDA ESE ID EN UN ARRAY EL CUAL SE USA COMO PARAMETRO PARA MANDAR LLAMAR LA FUNCION DEL MODELO BORRAR CATEGORIA

		LA FUNCION DEVUELVE UNA RESPUESTA Y ESTA SE CONDICIONA, SI ES SATISFACTORIA TE DEVUELVE A LA VISTA
	*/

	public function borrarCateController(){

		if(isset($_GET["id"])){

			$datosController = $_GET["id"];

			$datosController2 = array( "usuario"=>$_SESSION["user"],
									  "pass"=>$_GET["contra"]);


			$respuesta3 = Datos::ingresoUsuarioModel($datosController2,"users");


			if($respuesta3["user_password_hash"] == $datosController2["pass"])
			{
				$respuesta1 = Datos::borrarProdCateModel($datosController, "products");

				$respuesta = Datos::borrarCateModel($datosController, "categorias");

				if($respuesta == "success"){

					echo "<script>window.location='index.php?action=categorias';</script>";
			
				}
			}
			else
			{
				
				echo "<script>alert('ERROR- CONTRASEÑA INCORRECTA')</script>";
			}


			
			

		}

	}

	/*
		EN LA SIGUIENTE FUNCION SE MANDA EJECUTAR EL MODELO DE VISTA CATEGORIAS

		ESTE MODELO DEVUELVE UNA RESPUESTA, Y MEDIANTE ESA RESPUESTA SE MANDA IMPRIMIR UNA CAJA DE SELECCION CON TODAS LAS CATEGORIAS EXISTENTES EN LA BD
	*/

	public function CategoriasController(){


		$respuesta = Datos::vistaCateModel("categorias");


		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';

		}

	}

	/*
		EN LA SIGUIENTE FUNCION SE MANDA EJECUTAR EL MODELO DE VISTA PRODUCTOS

		ESTE MODELO DEVUELVE UNA RESPUESTA, Y MEDIANTE ESA RESPUESTA SE MANDA IMPRIMIR UNA CAJA DE SELECCION CON TODAS LOS PRODUCTOS EXISTENTES EN LA BD
	*/

	public function ProductosController(){


		$respuesta = Datos::vistaProdModel("products");

		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_producto"].'>'.$item["nombre_producto"].'</option>';

		}

	}







	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA USUARIOS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA USUARIO REGISTRADO
	*/

	public function vistaUsuariosController(){



		$respuesta = Datos::vistaUsuariosModel("users");

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["user_id"].'</td>
				<td>'.$item["firstname"].'</td>
				<td>'.$item["lastname"].'</td>
				<td>'.$item["user_name"].'</td>
				<td>'.$item["user_password_hash"].'</td>
				<td>'.$item["user_email"].'</td>
				<td>'.$item["date_added"].'</td>
				<td><a href="index.php?action=editar_usuario&id='.$item["user_id"].'"><button class="btn btn-block btn-primary btn-sm" >Modificar</button></a></td>
				<td><a href="index.php?action=borrar_usuario&idBorrar='.$item["user_id"].'"><button class="btn btn-block btn-danger btn-sm" >Eliminar</button></a></td>
			</tr>';

		}

	}
	

	/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LA CAJA DE TEXTO Y EN LOS SELECT DE LA VISTA, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO DE USUARIO DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE USUARIOS, SI NO REGRESA AL INDEX
	*/

	public function registroUsuarioController(){

		if(isset($_POST["guardar"]))
		{
	
				$datosController = array( "firstname"=>$_POST["nombre"],
										  "lastname"=>$_POST["apellido"],
										  "user_name"=>$_POST["usuario"],
										  "user_password_hash"=>$_POST["password"],
										"user_email"=>$_POST["correo"],
										"date_added"=>$_POST["fecha"]);
			
			$respuesta = Datos::registroUsuarioModel($datosController, "users");


			if($respuesta == "success"){

				echo "<script>window.location='index.php?action=usuarios';</script>";


			}

			else{

				echo "error";
			}

		}

	}

	/*
		EN LA SIGUIENTE FUNCION, SE TRAE EL ID DEL USUARIO QUE EL USUARIO DESEA MODIFICAR Y SE GUARDA EN UN ARRAY EL CUAL SE USA DESPUES COMO PARAMETRO PARA MANDAR EJECUTA UNA FUNCION DEL MODELO

		CON LA RESPUESTA QUE REGRESE LA FUNCION DEL MODELO SE IMPRIME LA VISTA CON LA RESPECTIVA INFORMACION DEL USUARIO SELECCIONADO

	*/

	public function editarUsuarioController(){

		

		$datosController = $_GET["id"];

		$respuesta = Datos::editarUsuarioModel($datosController, "users");

		echo '
				  <div class="form-group">
                    <label for="id_usuario">ID Usuario</label>
                    <input type="text" class="form-control" placeholder="" name="id_usuario" value="'.$respuesta["user_id"].'">
                  </div>

				  <div class="form-group">
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" class="form-control" placeholder="" name="nombre" value="'.$respuesta["firstname"].'">
                  </div>

                  <div class="form-group">
                    <label for="apellido">Apellido(s)</label>
                    <input type="text" class="form-control"  placeholder="" name="apellido" value="'.$respuesta["lastname"].'">
                  </div>

                  <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control"  placeholder="" name="usuario" value="'.$respuesta["user_name"].'">
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control"  placeholder="" name="password" value="'.$respuesta["user_password_hash"].'">
                  </div>

                  <div class="form-group">
                    <label for="correo">Correo Electronico</label>
                    <input type="text" class="form-control"  placeholder="" name="correo" value="'.$respuesta["user_email"].'">
                  </div>

                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control"  placeholder="" name="fecha" value="'.$respuesta["date_added"].'">
                  </div>
                  
  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger" style="width: 150px;" name="modificar">Modificar</button>

                </div>


		';

	}

	/*
		TENIENDO LA VISTA CON LA INFORMACION RESPECTIVA DE LO SELECCIONADO, SE CREA UNA FUNCION QUE PERMITA TRAER LA INFORMACION MODIFICADA DE EN LOS ELEMENTOS DE LA VISTA, SE GUARDA EN UN ARRAY, Y ESTE SE UTILIZA POSTERIORMENTE COMO PARAMETRO PARA EJECUTAR LA FUNCION DE ACTUALIZAR USUARIO DEL MODELO

		LA FUNCION DEL MODELO REGRESA UNA RESPUESTA, SI ES CORRECTA TE DIRECCIONA A LA VISTA, SI NO, TE MANDA UN ERROR
	*/

	public function actualizarUsuarioController(){


		if(isset($_POST["modificar"])){

			$datosController = array( "user_id"=>$_POST["id_usuario"],
							          "firstname"=>$_POST["nombre"],
							          "lastname"=>$_POST["apellido"],
							      	  "user_name"=>$_POST["usuario"],
							      	  "user_password_hash"=>$_POST["password"],
							      	  "user_email"=>$_POST["correo"],
							      	  "date_added"=>$_POST["fecha"]);


			$respuesta = Datos::actualizarUsuarioModel($datosController,"users");

			if($respuesta == "success"){

				echo "<script>window.location='index.php?action=usuarios';</script>";

			}

			else{

				echo "error";

			}

		}
	
	}

/*
		EN LA SIGUIENTE FUNCION SE TOMA EL ID DEL USUARIO QUE HAYA SELECCIONADO EL USUARIO PARA ELIMINAR, SE GUARDA ESE ID EN UN ARRAY EL CUAL SE USA COMO PARAMETRO PARA MANDAR LLAMAR LA FUNCION DEL MODELO BORRAR USUARIO

		LA FUNCION DEVUELVE UNA RESPUESTA Y ESTA SE CONDICIONA, SI ES SATISFACTORIA TE DEVUELVE A LA VISTA
	*/

	public function borrarUsuarioController(){



		if(isset($_GET["id"])){

			$datosController = $_GET["id"];

			$datosController2 = array( "usuario"=>$_SESSION["user"],
									  "pass"=>$_GET["contra"]);

			$respuesta3 = Datos::ingresoUsuarioModel($datosController2,"users");


			if($respuesta3["user_password_hash"] == $datosController2["pass"])
			{
				$respuesta = Datos::borrarUsuarioModel($datosController, "users");

				if($respuesta == "success"){

					echo "<script>window.location='index.php?action=usuarios';</script>";
			
				}
			}
			else
			{
				
				echo "<script>alert('ERROR- CONTRASEÑA INCORRECTA')</script>";
			}

		}

	}





/*
		EN LA SIGUIENTE FUNCION SE TOMA LO QUE HAYA INGRESADO EL USUARIO EN LA VISTA, SE CONDICIONA QUE SI SE OPRIME EL BOTON CON EL NOMBRE GUARDAR, SE TOMARA LO QUE HAYA INGRESADO EN LA CAJA DE TEXTO, Y ESTO SE GUARDA EN UN ARRAY, LA CUAL DESPUES SE USA COMO PARAMETRO PARA EJECUTAR LA FUNCION DE REGISTRO DE UN MOVIMIENTO DEL MODELO
		EL MODELO DEVUELVE UNA RESPUESTA, SI ES CORRECTA TE DEVUELVE A LA VISTA DE INVENTARIO, SI NO REGRESA AL INDEX
*/

public function registroMovController(){

		if(isset($_POST["guardar"]))
		{

			$datosController3 = array("id_producto" => $_POST["producto"]);
			

			$respuesta1 = Datos::editarProdModel($datosController3,"products");


			if((int)$respuesta1["stock"] >= (int)$_POST["cantidad"])
			{
				$respuesta4 = Datos::editarUsuarioModel2($_POST["usuario"],"users");

				$datosController = array( "usuario"=>$respuesta4["user_id"],
										  "fecha"=>$_POST["fecha"],
										  "producto"=>$_POST["producto"],
										  "nota"=>$_POST["nota"],
										  "referencia"=>$_POST["referencia"],
											"cantidad"=>$_POST["cantidad"]);

				$respuesta2 = Datos::registroMovModel($datosController,"historial");

				$cant = (int)$respuesta1["stock"] - (int)$_POST["cantidad"];

				$datosController2 = array("producto"=>$_POST["producto"],
											"cant" => $cant);

				$respuesta3 = Datos::movProdModel($datosController2,"products");

				if($respuesta3 == "success"){

					echo "<script>window.location='index.php?action=inventario';</script>";

				}

				else{

					echo "<script>window.location='index.php?action=movimiento';</script>";
				}
			}

			

			
		}

	}


/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA MOVIMIENTOS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA MOVIMIENTO REGISTRADO
	*/


	public function vistaMovController(){

		$respuesta = Datos::vistaMovModel("historial");

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_historial"].'</td>
				<td>'.$item["nomProd"].'</td>
				<td>'.$item["nomUser"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["nota"].'</td>
				<td>'.$item["referencia"].'</td>
				<td>'.$item["cantidad"].'</td> 
			</tr>';

		}

	}




}






////
?>