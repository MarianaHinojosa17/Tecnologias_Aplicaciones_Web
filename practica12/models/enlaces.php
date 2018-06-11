<?php 

/*
	SE CREA LA CLASE PAGINAS

	SE CREA LA FUNCION ENLACES PAGINAS, EN LA CUAL ES UNA SERIE DE CONDICIONES PARA SABER LA ACCION QUE EL USUARIO QUIERE REALIZAR Y HACIA DONDE SE VA ESA ACCION
*/


class Paginas{
	
	public static function enlacesPaginasModel($enlaces){




		if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir" || $enlaces == "carreras" ){

			$module =  "views/modules/".$enlaces.".php";
		
		}

		else if($enlaces == "index"){

			$module =  "views/modules/login.php";
		
		}

		else if($enlaces == "agregar_prod"){

			$module =  "views/modules/agregar_prod.php";
		
		}

		else if($enlaces == "productos"){

			$module =  "views/modules/productos.php";
		
		}

		else if($enlaces == "editar_prod"){

			$module =  "views/modules/editar_prod.php";
		
		}

		else if($enlaces == "borrar_prod"){

			$module =  "views/modules/borrar_prod.php";
		
		}

		else if($enlaces == "categorias"){

			$module =  "views/modules/categorias.php";
		
		}

		else if($enlaces == "usuarios"){

			$module =  "views/modules/usuarios.php";
		
		}

		else if($enlaces == "dashboard"){

			$module =  "views/modules/dashboard.php";
		
		}

		else if($enlaces == "agregar_categoria"){

			$module =  "views/modules/agregar_categoria.php";
		
		}

		else if($enlaces == "editar_categoria"){

			$module =  "views/modules/editar_categoria.php";
		
		}
		else if($enlaces == "borrar_categoria"){

			$module =  "views/modules/borrar_cate.php";
		
		}

		else if($enlaces == "agregar_usuario"){

			$module =  "views/modules/agregar_usuario.php";
		
		}

		else if($enlaces == "editar_usuario"){

			$module =  "views/modules/editar_usuario.php";
		
		}

		else if($enlaces == "borrar_usuario"){

			$module =  "views/modules/borrar_usuario.php";
		
		}

		else if($enlaces == "salir"){

			$module =  "views/modules/salir.php";
		
		}

		else if($enlaces == "inventario"){

			$module =  "views/modules/inventario.php";
		
		}

		else if($enlaces == "movimiento"){

			$module =  "views/modules/movimiento.php";
		
		}

		else if($enlaces == "tiendas"){

			$module =  "views/modules/tiendas.php";
		
		}

		else if($enlaces == "agregar_tienda"){

			$module =  "views/modules/agregar_tienda.php";
		
		}

		else if($enlaces == "editar_tienda"){

			$module =  "views/modules/editar_tienda.php";
		
		}

		else if($enlaces == "borrar_tienda"){

			$module =  "views/modules/borrar_tienda.php";
		
		}

		else if($enlaces == "ventas"){

			$module =  "views/modules/ventas.php";
		
		}

		else if($enlaces == "salir_tienda"){

			$module =  "views/modules/salir_tienda.php";
		
		}

		else if($enlaces == "estado_tienda"){

			$module =  "views/modules/estado_tienda.php";
		
		}

		else if($enlaces == "detalle_venta"){

			$module =  "views/modules/detalle_venta.php";
		
		}

		else if($enlaces == "agregar_venta"){

			$module =  "views/modules/agregar_venta.php";
		
		}



		else{

			$module =  "views/modules/registro.php";

		}

		
		
		return $module;

	}

}

?>