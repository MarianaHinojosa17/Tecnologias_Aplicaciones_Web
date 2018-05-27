








<?php

/*
	SE CREA LA CLASE CONEXION Y SE GUARDA LA INFORMACION NECESARIA PARA LA CONEXION CON LA BASE DE DATOS
*/

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=pract8","root","root");
		return $link;

	}

}

?>
