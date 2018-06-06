








<?php

/*
	SE CREA LA CLASE CONEXION Y SE GUARDA LA INFORMACION NECESARIA PARA LA CONEXION CON LA BASE DE DATOS
*/

class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=inventarios","root","root");
		return $link;

	}

}

?>
