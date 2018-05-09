<?php

  //Se manda llamar el archivo donde se tienen las funciones
  require_once('database_utilities.php');

  //Se almacenan en las variables correspondientes los datos del usuario
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

    //Se manda llamar la funcion de registrar y se le da como parametro el correo y la contraseña del usuario
    register($correo,$password);


º
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
        <h1>Usuario Nuevo</h1>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>Correo Electronico:  </label>
              <input type="email" name="email">
              <br>
              <label>Contraseña: </label>
              <input type="password" name="password">
              <br>
              <input type="submit" name="guardar" value="Registrar" class="button">
              </form>
            </div>
          </section>
        </div>
        
      </div>
    

    <?php require_once('footer.php'); ?>


