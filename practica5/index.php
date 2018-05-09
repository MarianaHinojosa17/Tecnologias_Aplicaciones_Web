<?php

//se manda llamar el archivo donde se tienen las funciones
require_once('database_utilities.php');

// se corre la funcion que trae los datos de los usuarios y los almacena en una variable
$res = run_query();
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
        <br><br><br>
        <h1>Usuarios Registrados</h1>
        <br><br>
        <!-- Se crea un boton que permite ir al archivo de registrar usuario nuevo -->
          <a href="./registrar_usuario.php" class="button radius tiny" style="background-color: green; color: white;">Registrar Usuario</a>
          
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if($res){ ?>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Correo</th>
                    <th width="250">Contraseña</th>
                    <th width="250">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $res as $id => $user ){ ?>
                  <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['password'] ?></td>
                    
                    <td>
                      <!--Se crea dos botones para cada registro que permite eliminar el registro seleccionado
                        o modificarlo, obteniendo su id y pasando la variable del mismo para poder trabajar con ella
                        en el archivo al que se dirige-->
                    <a href="./modificar_usuario.php?id=<?php echo $user['id']; ?>" class="button radius tiny success" style="background-color: blue; color: white;">Modificar</a>&nbsp;<a href="./eliminar.php?id=<?php echo $user['id']; ?>" class="button radius tiny alert" style="background-color: red; color: white;" onClick=eliminarAlert();>Eliminar</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="4"><b>Total de registros: </b> <?php echo $res->num_rows; ?></td>
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

<!--Se crea la funcion en java script la cual manda una alerta que es para confirmar el que se elimine
algun registro de la base de datos-->
    <script type="text/javascript">

      function eliminarAlert()
      {
        var msj = confirm("Deseas eliminar este usuario?");
        if(msj == false)
        {
          event.preventDefault();
        }
      }
    </script>