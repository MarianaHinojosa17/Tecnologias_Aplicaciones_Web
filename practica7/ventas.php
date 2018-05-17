<?php

//Se requiere el archivo database_utilities.php para poder usar las diferentes metodos que usaran las senetencias SQL
require_once('database_utilities.php');
$resultados = ventas();
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
              //Si se encuentran resultados se creara la tabla de las ventas registradas?>
              <br><br>
              <h1>Ventas Registradas</h1>
              <br><br><br>
              <a href="./agregar_venta.php" class="button radius tiny">Agregar Venta</a>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Monto</th>
                    <th width="250">Fecha</th>
                    <th width="250">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $resultados as $id => $user ){ 
                    // Se muestra en la tabla los datos de la venta, asi como la opcion de ver detalles de la venta, la cual nos direcciona a los detalles de cada venta, que productos contiene, cantidad, total, etc
                  ?>
                  <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['monto'] ?></td>
                    <td><?php echo $user['fecha'] ?></td>
                    <?php ?>
                    <td>
                    <a href="./detalle_venta.php?id=<?php echo $user['id']; ?>" class="button radius tiny success">Ver Detalles</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- Se hara un conteo de cada venta registrada -->
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