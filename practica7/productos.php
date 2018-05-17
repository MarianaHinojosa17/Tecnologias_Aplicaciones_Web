<?php

//Se requiere el archivo database_utilities.php para poder usar las diferentes metodos que usaran las senetencias SQL
require_once('database_utilities.php');
$resultados = productos();
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
              <h2>Productos Registrados</h2>
              <br><br>
              <a href="./agregar_producto.php" class="button radius tiny">Agregar Producto</a>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Nombre</th>
                    <th width="250">Precio Unitario</th>
                    <th width="250">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $resultados as $id => $user ){ 
                  ?>
                  <tr>
                    <?php //Se imprime en la tabla los datos tomados de $resultados de los productos registrados ?>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['nombre'] ?></td>
                    <td><?php echo $user['precio'] ?></td>
  
                    <td><a href="./eliminar_producto.php?id=<?php echo $user['id']; ?>" class="button radius tiny alert"  onClick=avoidDeleting();>Eliminar</a>
                    <a href="./modificar_producto.php?id=<?php echo $user['id']; ?>" class="button radius tiny success">Modificar</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- Se hara un conteo de cada producto registrado en la tabla-->
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