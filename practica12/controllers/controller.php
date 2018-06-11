<?php

$c = 0;

$productos = array();
$cantidad = array();

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

			$datosController2 = $respuesta["id_tienda"];

			$respuesta2 = Datos::nomTiendaModel($datosController2,"tiendas");




			if($respuesta["user_name"] == $datosController["usuario"] && $respuesta["user_password_hash"] == $datosController["pass"])
			{

				if ($respuesta2["estado"] == "Activo" ) {


					session_start();	


				$_SESSION["validar"] = true;

				$_SESSION["password"] = $datosController["pass"];

				$_SESSION["user"] = $datosController["usuario"];

				$_SESSION["id_tienda"] = $respuesta["id_tienda"];

				$_SESSION["nombre"] = $respuesta["firstname"];

				$_SESSION["id_user"] = $respuesta["user_id"];

				$_SESSION["c"] = 0;

				$_SESSION["productos"] = array();

				$_SESSION["precios"] = array();

				$_SESSION["cantidad"] = array();

				$_SESSION["total"] = 0;

				//$_SESSION["nomTienda"] = $respuesta2["nombre"];

				if ($_SESSION["id_tienda"] == '0') 
				{
					$_SESSION["nomTienda"] = "Control Inventario";

					echo "<script>window.location='index.php?action=tiendas';</script>";
				}
				else
				{
					$_SESSION["nomTienda"] = $respuesta2["nombre"];

					echo "<script>window.location='index.php?action=dashboard';</script>";
				}




				
					
				}
				else
				{

					echo '

					<script>

						swal({title: "Error", text: "La tienda ha sido desactivada!", type:"error"});

					 </script>

				';

				}




				


			}

			else{

				echo '

					<script>

						swal({title: "Error", text: "Credenciales Incorrectas!", type:"error"});

					 </script>

				';
			

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
		$datosController = $_SESSION["id_tienda"];

		$respuesta = Datos::vistaProdModel($datosController, "products");

		echo '<h3>'.sizeof($respuesta).'</h3>';

		
	}

	/*
 	EN LA SIGUIENTE FUNCION SE MANDA LLAMAR LA FUNCION VISTA MOVIMIENTOS MODELO PARA QUE MANDE TODO LO CONSULTADO Y PODAMOS IMPRIMIR EL TAMAÑO DEL ARRAY QUE RETORNA LA FUNCION DEL MODELO
 	ESTO SE PUEDE VER EN LOS CUADROS DE COLORES DEL DASHBOARD, DONDE CONTIENE LOS TOTALES
 */

	public function movimientosContController()
	{
		$datosController = $_SESSION["id_tienda"];
		$respuesta = Datos::vistaMovModel($datosController,"historial");

		echo '<h3>'.sizeof($respuesta).'</h3>';

		
	}

	/*
 	EN LA SIGUIENTE FUNCION SE MANDA LLAMAR LA FUNCION VISTA CATEGORIAS MODELO PARA QUE MANDE TODO LO CONSULTADO Y PODAMOS IMPRIMIR EL TAMAÑO DEL ARRAY QUE RETORNA LA FUNCION DEL MODELO
 	ESTO SE PUEDE VER EN LOS CUADROS DE COLORES DEL DASHBOARD, DONDE CONTIENE LOS TOTALES
 */

	public function cateContController()
	{
		$datosController = $_SESSION["id_tienda"];
		$respuesta = Datos::vistaCateModel($datosController,"categorias");

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
											"categoria"=>$_POST["categoria"],
											"id_tienda" => $_SESSION["id_tienda"]);
		

			$respuesta = Datos::registroProdModel($datosController, "products");

			if($respuesta == "success"){

				

				echo "<script>window.location='index.php?action=productos';</script>";

				echo '

					<script>

						swal({title: "Registro Satisfactorio", text: "Producto Registrado Satisfactoriamente!", type:"success"});

					 </script>

				';

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

		//echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa".$_SESSION["id_tienda"];


		$datosController = $_SESSION["id_tienda"];

		//echo $datosController;

		$respuesta = Datos::vistaProdModel($datosController, "products");

		

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_producto"].'</td>
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

		$datosController = $_SESSION["id_tienda"];

		$respuesta = Datos::vistaProdStockModel($datosController,"products");

		

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

		$datosController2 = $_SESSION["id_tienda"];

		$respuesta1 = Datos::vistaCateModel($datosController2,"categorias");

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
				/*echo '

					<script>

						swal({title: "Modificacion Realizada", text: "Producto Modificado Satisfactoriamente!", type:"success"});

					 </script>

				';*/

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

					/*echo '

					<script>

						swal({title: "Eliminado", text: "Producto Eliminado!!", type:"warning"});

					 </script>

				';
				*/
				
				}
			}
			else
			{
				
				/*echo '<br><br>

					<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-ban"></i>ERROR!</h5>
                  Contraseña Incorrecta!!
                </div>


				';*/

				echo '

					<script>

						swal({title: "Error", text: "Contraseña Incorrecta!!", type:"error"});

					 </script>

				';


			}

		}

	}



	/*
		SE CREA UNA FUNCION QUE EJECUTA UNA FUNCION DEL MODELO LLAMADA VISTA CATEGORIAS, DANDOLE COMO PARAMETRO EL NOMBRE DE LA TABLA DONDE SE ENCUENTRA LA INFORMACION

		LA FUNCION DEL MODELO DEVUELVE UN ARRAY CON LA INFORMACION QUE ENCONTRO, MEDIANTE UN CICLO SE IMPRIME EL CUERPO DE LA TABLA DE LA VISTA DANDO COMO CADA FILA CADA CATEGORIA REGISTRADA
	*/

	public function vistaCateController(){

		$datosController = $_SESSION["id_tienda"];

		$respuesta = Datos::vistaCateModel($datosController, "categorias");


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
										  "descripcion"=>$_POST["descripcion"],
										  "id_tienda" => $_SESSION["id_tienda"]
										  );
			
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
							      	  "descripcion"=>$_POST["descripcion"]
							      	  );

			

			//$respuesta1 = Datos::actualizarTiendaProdModel($datosController2,"products");
			
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
				echo '

					<script>

						swal({title: "Error", text: "Contraseña Incorrecta!!", type:"error"});

					 </script>

				';
				
				//echo "<script>alert('ERROR- CONTRASEÑA INCORRECTA')</script>";
			}


			
			

		}

	}

	/*
		EN LA SIGUIENTE FUNCION SE MANDA EJECUTAR EL MODELO DE VISTA CATEGORIAS

		ESTE MODELO DEVUELVE UNA RESPUESTA, Y MEDIANTE ESA RESPUESTA SE MANDA IMPRIMIR UNA CAJA DE SELECCION CON TODAS LAS CATEGORIAS EXISTENTES EN LA BD
	*/

	public function CategoriasController(){


		$datosController = $_SESSION["id_tienda"];
		$respuesta = Datos::vistaCateModel($datosController, "categorias");



		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';

		}

	}

	/*
		EN LA SIGUIENTE FUNCION SE MANDA EJECUTAR EL MODELO DE VISTA PRODUCTOS

		ESTE MODELO DEVUELVE UNA RESPUESTA, Y MEDIANTE ESA RESPUESTA SE MANDA IMPRIMIR UNA CAJA DE SELECCION CON TODAS LOS PRODUCTOS EXISTENTES EN LA BD
	*/

	public function ProductosController(){


		$datosController = $_SESSION["id_tienda"];

		$respuesta = Datos::vistaProdModel($datosController, "products");

		foreach($respuesta as $row => $item){

		echo '<option value='.$item["id_producto"].'>'.$item["nombre_producto"].'</option>';

		}

	}



	public function TiendasController(){


		$respuesta = Datos::vistaTiendasModel("tiendas");


		foreach($respuesta as $row => $item){

			if ($item["id_tienda"] != '0') 
			{
				echo '<option value='.$item["id_tienda"].'>'.$item["nombre"].'</option>';
			}

		

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
				<td>'.$item["date_added"].'</td>
				<td>'.$item["nomTienda"].'</td>
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
										"date_added"=>$_POST["fecha"],
										"id_tienda"=>$_POST["tienda"]);
			
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

		$respuesta1 = Datos::vistaTiendasModel("tiendas");

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

                  <div class="form-group">
                    <label for="tienda">Tienda</label>
                    <br>
                    <select name="tienda" style="width: 660px;" class="form-control select2 select2-hidden-accessible">';


					foreach($respuesta1 as $row => $item){

						if ($item["id_tienda"] == $respuesta["id_tienda"]) {
						echo '<option value='.$item["id_tienda"].' selected>'.$item["nombre"].'</option>';
					}
					else
					{
						echo '<option value='.$item["id_tienda"].'>'.$item["nombre"].'</option>';
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
							      	  "date_added"=>$_POST["fecha"],
							      		"id_tienda" => $_POST["tienda"]);


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
				echo '

					<script>

						swal({title: "Error", text: "Contraseña Incorrecta!!", type:"error"});

					 </script>

				';
				//echo "<script>alert('ERROR- CONTRASEÑA INCORRECTA')</script>";
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
											"cantidad"=>$_POST["cantidad"],
										   "id_tienda" => $_SESSION["id_tienda"]);

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

		$datosController = $_SESSION["id_tienda"];

		$respuesta = Datos::vistaMovModel($datosController, "historial");

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


	public function vistaTiendasController(){




		$respuesta = Datos::vistaTiendasModel("tiendas");

		

		foreach($respuesta as $row => $item){

		if($item["estado"] == "Activo")
		{
			$label = "Desactivar";
		}
		else
		{
			$label = "Activar";
		}

		if($item["id_tienda"] != "0")
		{
			echo'<tr>
				<td>'.$item["id_tienda"].'</td>
				<td>'.$item["codigo"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["descripcion"].'</td>
				<td>'.$item["fecha"].'</td>
				<td><a href="index.php?action=estado_tienda&id='.$item["id_tienda"].'&estado='.$item["estado"].'"><button class="btn btn-block btn-warning btn-sm" >'.$label.'</button></a></td>
				<td><a href="index.php?action=editar_tienda&id='.$item["id_tienda"].'"><button class="btn btn-block btn-primary btn-sm">Modificar</button></a></td>
				<td><a href="index.php?action=tiendas&idCambiar='.$item["id_tienda"].'"><button class="btn btn-block btn-info btn-sm">Ir a tienda</button></a></td>
			</tr>';
		}

		

		}

	}


	public function registroTiendaController(){

		if(isset($_POST["guardar"]))
		{
			
				$datosController = array( "codigo"=>$_POST["codigo"],
										  "nombre"=>$_POST["nombre"],
										  "descripcion"=>$_POST["descripcion"],
										  "fecha"=>$_POST["fecha"],
										  "estado"=>$_POST["estado"]
										  );
			
			$respuesta = Datos::registroTiendaModel($datosController, "tiendas");

			if($respuesta == "success"){

				//header("location:index.php?action=categorias");
				echo "<script>window.location='index.php?action=tiendas';</script>";

			}

			else{

				//header("location:index.php?action=agregar_categoria");
				echo "<script>window.location='index.php?action=agregar_tienda';</script>";
			}

		}

	}

	public function editarTiendaController(){


		$datosController = $_GET["id"];

		

		$respuesta = Datos::editarTiendaModel($datosController, "tiendas");


		echo '

				<div class="form-group">
                    <label for="ID Tienda">Codigo</label>
                    <input type="text" class="form-control" id="nombre_categoria" placeholder="" name="id_tienda" value="'.$respuesta["id_tienda"].'" readonly>
                  </div>

				<div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" class="form-control" id="nombre_categoria" placeholder="" name="codigo" value="'.$respuesta["codigo"].'">
                  </div>

                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre_categoria" placeholder="" name="nombre" value="'.$respuesta["nombre"].'">
                  </div>

                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control"  placeholder="" name="fecha" value="'.$respuesta["fecha"].'">
                  </div>

                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" style="width: 660px;" class="form-control select2 select2-hidden-accessible">';

                    if($respuesta["estado"] == "Activo")
                    {
                    	echo '<option value="Activo" selected >Activo</option>';
                    }
                    else
                    {
                    	echo '<option value="Activo">Activo</option>';
                    }

                    if($respuesta["estado"] == "Desactivo")
                    {
                    	echo '<option value="Desactivo" selected >Desactivo</option>';
                    }
                    else
                    {
                    	echo '<option value="Desactivo">Desactivo</option>';
                    }

                    

                  echo '</select>
                  </div>

                  <div class="form-group">
                    <label for="fecha">Descripcion</label>
                    <textarea class="form-control" rows="3" placeholder="" name="descripcion">'.$respuesta["descripcion"].'</textarea>
                  </div>

                  
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger" style="width: 150px;" name="modificar">Modificar</button>

                </div>




		';

	}


	public function actualizarTiendaController(){

		//echo "hola";

		if(isset($_POST["modificar"])){

			$datosController = array( "id_tienda"=>$_POST["id_tienda"],
									  "codigo"=>$_POST["codigo"],
							          "nombre"=>$_POST["nombre"],
							      	  "descripcion"=>$_POST["descripcion"],
							      	  "fecha"=>$_POST["fecha"],
							      	  "estado"=>$_POST["estado"]
							      	  );

			

			//$respuesta1 = Datos::actualizarTiendaProdModel($datosController2,"products");
			
			$respuesta = Datos::actualizarTiendaModel($datosController, "tiendas");


			if($respuesta == "success"){

				echo "<script>window.location='index.php?action=tiendas';</script>";

			}

			else{

				echo "<script>window.location='index.php?action=editar_tienda';</script>";

			}

		}
	
	}



	/*public function borrarTiendaController(){


		if(isset($_GET["id"])){

			

			if($_GET["estado"] == "Activo")
			{

				$datosController = array ("estado" => "Desactivo",
											"id_tienda" => $_GET["id"]);
			}
			else
			{
				$datosController = array ("estado" => "Activo",
											"id_tienda" => $_GET["id"]);
			}
			


			$datosController2 = array( "usuario"=>$_SESSION["user"],
									  "pass"=>$_GET["contra"]);
	

			$respuesta3 = Datos::ingresoUsuarioModel($datosController2,"users");


			if($respuesta3["user_password_hash"] == $datosController2["pass"])
			{
				$respuesta = Datos::estadoTiendaModel($datosController, "tiendas");



				if($respuesta == "success"){

					echo "<script>window.location='index.php?action=tiendas';</script>";
				
				}

			}	
			
			else
			{
				
				echo "<script>alert('ERROR- CONTRASEÑA INCORRECTA')</script>";
			}

		}

	}*/



	public function ingresarTiendaController()
	{
			if(isset($_GET['idCambiar']))
			{
				$_SESSION['id_tienda'] = $_GET['idCambiar'];

				echo"<script>
						window.location = 'index.php?action=dashboard';
					</script>";

					//$_SESSION["id_tienda"] = '001';

			}
	}

	public function vistaVentaController(){


		$datosController = $_SESSION["id_tienda"];

		//echo $datosController;

		$respuesta = Datos::vistaVentaModel($datosController, "venta");

		

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_venta"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["total"].'</td>
				<td><a href="index.php?action=detalle_venta&id='.$item["id_venta"].'"><button class="btn btn-block btn-danger btn-sm"><i class="nav-icon fa fa-plus"></i></button></a></td>
				
			</tr>';

		}

	}

	public function salirTiendaController(){


		//echo "holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

		

		echo"<script>
					window.location = 'index.php?action=dashboard';
			</script>";

		$_SESSION["id_tienda"] = '0';

		//print_r($_SESSION["id_tienda"]);


	}

	public function cambiarEstadoController(){

		//echo"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

		//echo "<script>alert('holaaaaaaa');</script>";

		if($_GET["estado"] == "Activo")
		{
			$label = "Desactivo";
		}
		else
		{
			$label = "Activo";
		}

		$datosController = array("id_tienda" => $_GET["id"],
								"estado" => $label);

		$respuesta = Datos::cambiarEstadoModel($datosController,"tiendas");

		if($respuesta == "success"){

			echo '

					<script>

						swal({title: "Cuidado", text: "Se ha cambiado el estado de la tienda!!", type:"warning"});

					 </script>

				';

			//echo "<script>window.location='index.php?action=tiendas';</script>";
				
		}

	}

	public function vistaDetController(){



		$datosController = array("id_tienda" => $_SESSION["id_tienda"],
								 "id_venta" => $_GET["id"]);



		//echo $datosController;

		$respuesta = Datos::vistaDetModel($datosController, "info_venta");

		

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_venta"].'</td>
				<td>'.$item["nomProd"].'</td>
				<td>'.$item["cantidad"].'</td>
				<td>'.$item["precio"].'</td>
				
			</tr>';

		}


	}

	//$_SESSION["c"] = 0;

	

	public function agregarProdController(){
		



		if(isset($_POST["agregar"])) {


			$_SESSION["c"] = $_SESSION["c"] + 1;

			$_SESSION["productos"][$_SESSION["c"]] = $_POST["producto"];

			$_SESSION["cantidad"][$_SESSION["c"]] = $_POST["cantidad"];

			$respuesta2 = Datos::editarProdModel($_POST["producto"],"products");

			$total = $_SESSION["total"];

			$precio = (float)$respuesta2["precio_producto"];

			$cantidad = (int)$_POST["cantidad"];

			$total = $total + $precio * $cantidad;

			$_SESSION["total"] = $total;

			$_SESSION["precios"][$_SESSION["c"]] = $respuesta2["precio_producto"];


			for($i = 0; $i<= sizeof($_SESSION["productos"]) ; $i++)
			{
				$respuesta = Datos::editarProdModel($_SESSION["productos"][$i],"products");
				echo'<tr>
					<td>'.$respuesta["nombre_producto"].'</td>
					<td>'.$respuesta["precio_producto"].'</td>
					<td>'.$_SESSION["cantidad"][$i].'</td>
				
					</tr>';

			}

			echo '


				<div class="form-group">
                    <br>
                    <label for="total">Total</label>
                    <input type="text" class="form-control"  placeholder="" name="total" id="total" readonly="" style="width: 150px;" value="'.$_SESSION["total"].'" >
                  </div>

			';

		}



	}


	public function agregarVentaController(){

		if (isset($_POST["guardar"])) {

			$datosController = array("id_tienda" => $_SESSION["id_tienda"],
									"fecha" => $_POST["fecha"],
									"total" => $_POST["total"]);

			$respuesta = Datos::agregarVentaModel($datosController,"venta");



			$respuesta2 = Datos::ultimo($_SESSION["id_tienda"],"venta");
			
			for($i = 0; $i<=sizeof($_SESSION["productos"]); $i++)
			{
				

				$datosController2 = array("id_producto" => $_SESSION["productos"][$i],
											"id_venta" => $respuesta2[0]["id_venta"],
										"precio" => $_SESSION["precios"][$i],
										"cant" => $_SESSION["cantidad"] [$i]);

				/*$respuesta5 = Datos::editarProdModel($_SESSION["productos"][$i]);

				$stock = (int)$respuesta5["stock"];

				$stock = $stock - (int)$_SESSION["cantidad"][$i];

				$datosController3 = array("producto" => $_SESSION["productos"][$i],
										"cant" => $stock);*/
				//print_r($datosController2);

				$respuesta3 = Datos::agregarDetModel($datosController2,"info_venta");

				//$respuesta4 = Datos::movProdModel($datosController3,"products");
			}



			$_SESSION["total"] = 0;

			$_SESSION["productos"] = array();

			$_SESSION["precios"] = array();

			$_SESSION["cantidad"] = array();

			$_SESSION["c"] = 0;
		}

		if($respuesta3 == "success"){

			echo '

					<script>

						swal({title: "Exitoso", text: "Registro de Venta Exitoso!!", type:"success"});
 
					 </script>

				';

			//echo "<script>window.location='index.php?action=tiendas';</script>";
				
		}

	}




}






////
?>