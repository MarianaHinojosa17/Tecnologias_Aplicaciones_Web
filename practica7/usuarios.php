<?php

//Se requiere el archivo database_utilities.php para poder usar las diferentes metodos que usaran las senetencias SQL
require_once('database_utilities.php');
$resultados = usuarios();
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
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if($resultados){ 
              //Si hay resultados entonces se hara la tabla?>
              <br><br>
              <h2>Usuarios Registrados</h2>
              <br><br><br>
              <a href="./agregar_usuario.php" class="button radius tiny">Nuevo Usuario</a>
              <br>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Usuario</th>
                    <th width="250">Password</th>
                    <th width="250">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $resultados as $id => $user ){ 
                  //Se imprime la informacion obtenida por la funcion usuarios(), la cual trae toda la informacion de los usuarios registrados
                  ?>
                  <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['usuario'] ?></td>
                    <td><?php echo $user['password'] ?></td>
                    <?php ?>
                    <td><a href="./eliminar_usuario.php?id=<?php echo $user['id']; ?>" class="button radius tiny alert"  onClick=avoidDeleting();>Eliminar</a>
                    <a href="./modificar_usuario.php?id=<?php echo $user['id']; ?>" class="button radius tiny success">Actualizar</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- Se hara un conteo de cada usuario registrado -->
                    <td colspan="6"><b>Total de registros: </b> <?php echo count($resultados); ?></td>
                  </tr>
                </tbody>
              </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>
            </div>
          </section>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>

    <script type="text/javascript">

      //Funcion para crear la alerta de estar seguros si queremos eliminar el usuario
      function avoidDeleting()
      {
        var msj = confirm("Deseas eliminar este usuario?");
        if(msj == false)
        {
          event.preventDefault();
        }
      }
    </script>