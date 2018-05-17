<?php

  //Requiere el archivo php donde estan todos los metodos que haran la sentencia SQL
  require_once('database_utilities.php');


//Se guardan en las variables lo registrado en el formulario cuando el usuario presione la tecla registrar 

  if(isset($_POST["registrar"]))
  {


    if(isset($_POST["fecha"])) 
    {
      $fecha =  $_POST["fecha"];
    }

    if(isset($_POST["total"]))
    {
      $total = $_POST["total"];
    }

    agregarVenta($total,$fecha);

    $id_venta = ultimaVenta();

    $i=1;

    
    //echo $_POST["cont"];
            
    while($i<=$_POST["cont"])
    {
              
      $nombre_prod = $_POST["prod".$i];
      echo($nombre_prod);
      $cant = $_POST["cant".$i];
      $precio = $_POST["precio".$i];

      $id_prod = idProd($nombre_prod);

      agregarDetVenta($id_venta,$id_prod,$cant,$precio);

      $i++;
    }


    header("Location:ventas.php");
  
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
 
    <form method="POST" action="">
      
        <br><br>
        <!-- Aqui se imprime el letrero de formulario y acontinuacion una variable PHP que dira que tipo de deportista es si
        Futbolista o Basquetbolista -->
        <h2>Nueva Venta</h2>
        <br><br>
        
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              
              <label>Fecha </label>
              <input type="text" name="fecha" style="width: 400px;" id="fecha">
              <br>
              <label>Total </label>
              <input type="text" name="total" style="width: 400px;" id="total" readonly>
              <br>
              <hr width="500px;">
              <div name="div1" id="div1" style="width: 1000px;">
              <h3>Agregar Producto</h3>
              <br>
              <label>Producto </label>
              <select name="producto" id="producto" style="width: 400px;" >
                <?php 
                  $resultados = productos();
                  foreach( $resultados as $id => $user){
                 ?>
                  <option value="<?php echo $user['id']; ?>" ><?php echo $user['nombre'] . "$" . $user['precio']; ?></option>

               <?php } ?>
              </select>

              <br>
              <label>Cantidad </label>
              <input type="number" name="cantidad" id="cantidad" style="width: 400px;">
              <input type="button" name="add" value="Agregar" onclick="agregarProd();" class="button radius tiny">
              <br><br>
              </div>
              <hr width="500px">
              <input type="submit" name="registrar" value="Registrar Venta" class="button" id="btn">
              </form>
            </div>
          </section>
        
        
      
    

    <?php require_once('footer.php'); ?>

  <script type="text/javascript">
      
    //Se crea una variable donde se almacenara la fecha actual, para poder visualizarse en el formulario en el campo d texto fecha

      var fecha = document.getElementById('fecha');

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();

        if(dd<10) 
        {
          dd = '0'+dd
        } 

        if(mm<10) 
        {
          mm = '0'+mm
        } 

        today = yyyy + '-' + mm + '-' + dd;
      

      fecha.setAttribute("value",today);



      //Se crean las variables necesarias para poder crear la tabla dinamica donde se mostraran los productos que se esten ingresando a la venta.

      var cont = document.createElement("input");

      var total = 0;

      var c = 0;

      var div1 = document.getElementById("div1");

      var lTitulo = document.createElement("h4");

      lTitulo.innerHTML = "Lista Articulos Agregados";

      div1.appendChild(lTitulo);

      var br = document.createElement("br");


      var lDet = document.createElement("h5");

      lDet.innerHTML = "Articulo ----------- Precio ----------- Cantidad ";

      //div1.appendChild(lDet);

      var total1 = document.getElementById("total");

      cont.setAttribute("type","hidden");

      cont.setAttribute("name","cont");

      div1.appendChild(cont);




      //Se crea una funcion en la cual cada que el usuario quiera registrar un producto crea dinamicamente los input del producto, el precio, y la cantidad que desea
      function agregarProd()
      {

      	//Se suma el contador
        c++;


        //Se crean las variables necesarias para la parte estatica y dinamica de agregar producto a la venta.
        var l1 = document.createElement("label");

      	var l2 = document.createElement("label");

      	var l3 = document.createElement("label");

      	l1.innerHTML = "Producto ";

      	l2.innerHTML = "Precio ";

      	l3.innerHTML = "Cantidad ";

      	//Se crea una variable que toma lo que contiene el select del producto

        var combo = document.getElementById("producto");

        //Se toma el texto de ese producto

        var selected = combo.options[combo.selectedIndex].text;

        //Y se divide, de tal forma que nos separe el nombre del producto y su precio

        var res = selected.split("$");

        //Se almacena el nombre y el producto del array donde se dividio del select

        var nombre_prod = res[0];

        var precio = res[1];

        var cantidad = document.getElementById("cantidad").value;

        var lArt = document.createElement("input");

        var lCant = document.createElement("input");

        var lPrecio = document.createElement("input");

        var br2 = document.createElement("br");

        //Se le asignan los atributos necesarios a las variables creadas anteriormente, como un valor el cual es el texto que se muestra, un estilo, que solo sea un input de lectura, y se le da un nombre dinamico, es decir con un contador para que cada producto que se agregue tenga un nombre diferente y se pueda agregar correctamente a la base de datos

        lArt.setAttribute("value", nombre_prod);

        lArt.setAttribute("style", "width:150px;");

        lArt.setAttribute("class", "n");

        lArt.setAttribute("readonly","");

        lArt.name = "prod" + c;

        lPrecio.setAttribute("value",precio);

        lPrecio.setAttribute("style", "width:150px;");

        lPrecio.setAttribute("class", "n");

        lPrecio.setAttribute("readonly","");

        lPrecio.name = "precio" + c;

        lCant.setAttribute("value", cantidad);

        lCant.setAttribute("style", "width:150px;")

        lArt.setAttribute("class", "n");

        lCant.setAttribute("readonly","");

        lCant.name = "cant" + c;

        //Se agregan las variables creeadas con sus atributos al div, para que se muestre la informacion del producto que el usuario agrego

        div1.appendChild(l1);

        div1.appendChild(lArt);

        div1.appendChild(l2);

        div1.appendChild(lPrecio);

        div1.appendChild(l3);

        div1.appendChild(lCant);

        div1.appendChild(br2);

        div1.appendChild(br2);

        total = total + (precio*cantidad);

        total1.setAttribute("value",total);

        cont.setAttribute("value",c);



      }

    </script>


