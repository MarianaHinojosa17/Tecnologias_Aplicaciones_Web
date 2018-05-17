<?php
include_once('database_utilities.php');

//Se trae el id de la venta que se selecciono
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';


//Se guarda en la variable resultados la informacion que retorna la funcion detallesVenta, dando como parametro el id de la venta que queremos que nos muestre la informacion
$resultados = detalleVenta($id);

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <?php require_once('header.php'); ?>

    <center>
    <div class="row">
        
        <br><br>
      
        <h2>Detalles de la Venta</h2>
        <br><br>
          
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <ul class="pricing-table">
                <!-- Se muestra en una pequeña tabla todos los productos que contiene esa venta y la cantidad de ellos -->
                <li class="title">Venta Num.  <?php echo $resultados[0]['id_venta']?></li>
                <?php foreach( $resultados as $id => $user ){ ?>
                <li class="description" >
                Producto: <?php echo $user['nombre'] ?><br>
                Cantidad: <?php echo $user['cantidad'] ?><br>
                Promedio de Prenda: <?php echo $user['prom_prenda'] ?><br>
                Total: <?php echo $user['precio'] * $user['cantidad'] ?>
                </li>
                <?php } ?>
              </ul>

              <a href="./ventas.php" class="button">Regresar</a>

            </div> 
          </section>
        </div>
      
    </div>
    </center>
     
    <?php require_once('footer.php'); ?>