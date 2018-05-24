<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){


		if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir" || $enlaces == "carreras" ){

			$module =  "views/modules/".$enlaces.".php";
		
		}

		else if($enlaces == "index"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($enlaces == "carreras"){

			$module =  "views/modules/carreras.php";
		
		}

		else if($enlaces == "agregar_carrera"){

			$module =  "views/modules/agregar_carrera.php";
		
		}

		else if($enlaces == "cambio_carrera"){

			$module =  "views/modules/carreras.php";
		
		}

		else if($enlaces == "editar_carrera"){

			$module =  "views/modules/editar_carrera.php";
		
		}

		else if($enlaces == "borrar_carrera"){

			$module =  "views/modules/borrar_carrera.php";
		
		}

		else if($enlaces == "maestros"){

			$module =  "views/modules/maestros.php";
		
		}

		else if($enlaces == "agregar_maestro"){

			$module =  "views/modules/agregar_maestro.php";
		
		}

		else if($enlaces == "editar_maestro"){

			$module =  "views/modules/editar_maestro.php";
		
		}

		else if($enlaces == "borrar_maestro"){

			$module =  "views/modules/borrar_maestro.php";
		
		}

		else if($enlaces == "alumnos"){

			$module =  "views/modules/alumnos.php";
		
		}

		else if($enlaces == "agregar_alumno"){

			$module =  "views/modules/agregar_alumno.php";
		
		}

		else if($enlaces == "editar_alumno"){

			$module =  "views/modules/editar_alumno.php";
		
		}

		else if($enlaces == "borrar_alumno"){

			$module =  "views/modules/borrar_alumno.php";
		
		}

		else if($enlaces == "tutorias"){

			$module =  "views/modules/tutorias.php";
		
		}

		else if($enlaces == "agregar_tutoria"){

			$module =  "views/modules/agregar_tutoria.php";
		
		}

		else if($enlaces == "detalles_tuto"){

			$module =  "views/modules/detalles_tuto.php";
		
		}

		else{

			$module =  "views/modules/registro.php";

		}

		
		
		return $module;

	}

}

?>