<?php
// EL INDEX. En el mostraremos la salida de las vistas al usuario y tambien a traves de el enviaemos las distintas acciones que el usuario envíe al controlador.

//SE INVOCA LOS ARCHIVOS NECESARIOS
//EL QUE TIENE LAS ACCIONES DE LOS ENLACES Y EL CRUD DEL MODELO
//Y EL CONTROLADOR 
require_once "models/enlaces.php";
require_once "models/crud.php";
require_once "controllers/controller.php";

/*
	SE CREA UN OBJETO DE LA CLASE DEL CONTROLADOR, Y SE MANDA LLAMAR LA FUNCION PAGINA
*/

$mvc = new MvcController();
$mvc -> pagina();




/*
	SE CREA UN SCRIPT NECESARIO PARA LOS DATA TABLE QUE UTILIZAREMOS EN LA SECCION DE REPORTES
*/

?>

<script type="text/javascript">
	
	$(document).ready(function(){
		$(".js-example-basic-single").select2();
		$('#example').DataTable();
		$('#example2').DataTable();
		$('#example3').DataTable();
		$('#example4').DataTable();
		$('#example5').DataTable();
		$('#example6').DataTable();
		$('#example7').DataTable();
		$('#example8').DataTable();

	});

</script>



