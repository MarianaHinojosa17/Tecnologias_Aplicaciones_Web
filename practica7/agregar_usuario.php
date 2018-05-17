<?php

  //Requiere el archivo php donde estan todos los metodos que haran la sentencia SQL
  require_once('database_utilities.php');


  //Despues de presionar el boton de registrar, se usara el metodo POST para guardar los datos y mandar llamar la funcion agregarUusuario que registrara el nuevo usuario
  if(isset($_POST["guardar"]))
  {
    if(isset($_POST["usuario"])) 
    {
      $usuario =  $_POST["usuario"];
    }

    if(isset($_POST["password"]))
    {
      $password = $_POST["password"];
    }


    agregarUsuario($usuario,$password);

    header("Location: usuarios.php");
  
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
        <!-- Se crea el formulario para el registro del nuevo usuario -->
        <h2>Nuevo Usuario</h2>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>Usuario  </label>
              <input type="text" name="usuario" style="width: 400px;">
              <br>
              <label>Password: </label>
              <input type="password" name="password" style="width: 400px;">
              <br>
              <input type="submit" name="guardar" value="Registrar" class="button">
              </form>
            </div>
          </section>
        </div>
        
      </div>
    

    <?php require_once('footer.php'); ?>


