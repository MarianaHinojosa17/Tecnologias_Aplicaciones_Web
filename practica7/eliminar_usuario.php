<?php

//El id se pasara por medio de url dependiendo del usuario que elegimos para eliminar y asi poder eliminar el usuario correcto
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';

//Se requerira el archivo database_utilities.php donde se tendran los distintos metodos de las diferentes sentencias sql
require_once('database_utilities.php');

//Borraremos el usuario con la siguiente funcion 
eliminarUsuario($id);

//Se redirigira automaticamente a las tablas de deportistas
header('Location: usuarios.php')
?>