<?php

//Se manda llamar el archivo donde se tienen las funciones

require_once('database_utilities.php');

// se toma el id del registro seleccionado
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';

//se manda llamar la funcion de eliminar y se le da como parametro el id
delete($id);

header('Location: index.php')
?>