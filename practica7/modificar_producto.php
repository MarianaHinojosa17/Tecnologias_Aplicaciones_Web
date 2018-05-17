<?php

  //Se obtiene el id del producto que fue seleccionado por paso de variable
  $id = isset( $_GET['id'] ) ? $_GET['id'] : '';

  //Se requiere el archivo database_utilities.php para los distintos metodos con sentencias SQL
  require_once('database_utilities.php');

  //Se busca la informacion de ese producto mediante el id tomado anteriormente, llamando a la funcion buscarIdProd
  $resultados = buscarIdProd($id);

  //Despues de que los datos fueron cambiados y se presiono el boton de guardar, se mandan llamar los datos para poder registrarlos en la base de datos  
  if(isset($_POST["guardar"]))
  {
    if(isset($_POST["nombre"])) 
    {
      $nombre =  $_POST["nombre"];
    }

    if(isset($_POST["precio"]))
    {
      $precio = $_POST["precio"];
    }


    modificarProd($id,$nombre,$precio);

    header("Location:productos.php");
  
  }


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

     
    <div class="row">
 
    
      <div class="large-9 columns">
        <br><br>
        <h2>Modificar Producto</h2>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>Nombre </label>
              <input type="text" name="nombre" value="<?php echo $resultados['nombre'];?>" style="width: 400px;">
              <br>
              <label>Precio </label>
              <input type="text" name="precio" value="<?php echo $resultados['precio'];?>" style="width: 400px;">
              <br>
              <input type="submit" name="guardar" value="Actualizar" class="button radius tiny success" onClick=avoidDeleting();>
              </form>
            </div>
          </section>
        </div>
        
      </div>
    
    <script type="text/javascript">

      //Funcion para crear la alerta de estar seguros si queremos actualizar el producto
      function avoidDeleting()
      {
        var msj = confirm("Deseas actualizar este producto?");
        if(msj == false)
        {
          event.preventDefault();
        }
      }
    </script>

    <?php require_once('footer.php'); ?>


