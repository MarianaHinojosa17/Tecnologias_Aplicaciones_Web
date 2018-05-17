<?php

//El id se pasara por medio de url dependiendo del producto que elegimos para eliminar 
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';

//Se requerira el archivo database_utilities.php donde se tendran los distintos metodos de las diferentes sentencias sql
require_once('database_utilities.php');

//Borraremos el producto que se selecciono mediante la funcion eliminarProd
eliminarProd($id);


header('Location: productos.php')
?>