<?php

  //Se manda llamar el archivo donde se tienen las funciones
  require_once('database_utilities.php');


// Se guardan los datos a modificar del usuario en las variables correspondientes
  $id = isset( $_GET['id'] ) ? $_GET['id'] : '';

  //Se manda llamar la funcion de buscar por id, y trae el resultado de la funcion en una variable, en este caso
  // los datos del registro con el id que se selecciono
  $res = search_id($id); 

  if(isset($_POST["guardar"]))
  {
    if(isset($_POST["email"])) 
    {
      $correo =  $_POST["email"];
    }

    if(isset($_POST["password"]))
    {
      $password = $_POST["password"];
    }

    //se manda llamar la funcion de modificar, y se le da como parametros los datos del usuario

    update($id,$correo,$password);




    header("location: index.php");
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
        <h1>Modificar Usuario</h1>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
                <!--Se imprimen en los elementos los datos del registro seleccionado,traidos por la funcion buscar id-->
              <label>Correo Electronico:  </label>
              <input type="email" name="email" value="<?php echo $res['email']?>">
              <br>
              <label>Contraseña: </label>
              <input type="text" name="password" value='<?php echo $res['password']?>'>
              <br>
              <input type="submit" name="guardar" value="GUARDAR" class="button">
              </form>
            </div>
          </section>
        </div>
        
      </div>
    

    <?php require_once('footer.php'); ?>


