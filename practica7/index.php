<?php

require_once('database_utilities.php');


//Se realiza el inicio de sesion utilizando las cookies como ayuda para guardar el usuario
if( isset($_COOKIE)
    &&is_array($_COOKIE)
    && count($_COOKIE)>0
    && isset($_COOKIE['username'])
    && $_COOKIE['username']!=null
){
    session_start();
    $_SESSION['username']=$_COOKIE['username'];
}


if(isset($_GET['action'])
    && $_GET['action']=='logout'){
    //session_destroy();
    unset($_SESSION['username']);
}
if (isset($_POST['formu'])){

//Imprime el array con los datos de acceso, una vez logueado
    if( isset($_POST['formu']['nombre'])
        &&isset($_POST['formu']['pass'])
        &&usuarioValid($_POST['formu']['nombre'],$_POST['formu']['pass'])
    ){
        session_start();
        $_SESSION['username']=$_POST['formu']['nombre'];
        setcookie("username", $_POST['formu']['nombre']);
    }

}?>
<html>
<head>
    <title>Sesiones en PHP7</title>
</head>

<body>
<?php
if( isset($_SESSION)
    &&is_array($_SESSION)
    && count($_SESSION)>0
){
    ?>
    
    <?php
}
if(isset($_SESSION['username'])){
    


    //Si se encuentra dentro del inicio de sesion se muestran los siguientes elementos
    ?>
    <?php
    include_once('header.php');
    
    echo "<a href='?action=logout' style='margin: right;' class='button'>Logout</a> ";
    echo "<div align='center'>";
    echo "<h1>BIENVENIDO</h1>";
    echo "<h2>".$_SESSION['username']."</h2>";
    echo "<hr width='800px'> <br> <br>";
    echo "<a class='button' style='width:150px;' href='./ventas.php' >Venta</a><br>";
    echo "<a href='./productos.php' class='button' style='width:150px;'>Productos</a><br>";
    echo "<a href='./usuarios.php' class='button' style='width:150px;'>Usuarios</a><br><br>";
    echo "</div>";
    
    include_once('footer.php');
}else{
    



    //Si se encuentra fuera del inicio de sesion, se muestra un pequeño formulario para poder logearte.
    //Estando loggeado entra la condicion de arriba y te muestra lo de arriba
    ?>

    <?php require_once('header.php'); ?>
    <center>
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
            <br><br>
            <h1>Inicio de Sesion</h1>
            <br><br>
            <FORM ACTION="index.php" name="formu" METHOD="post">
          <label for="nombre">Usuario</label>
          <input style="width: 300px;" type="text" name="formu[nombre]"  id="nombre"
               


               value="<?php
               if(isset($_POST['formu']['nombre'])&&$_POST['formu']['nombre']!=null){
                   echo $_POST['formu']['nombre'];
               }
               ?>">


          <br/>
          <label for="valor">Contraseña</label>
          <input style="width: 300px;" type="password" name="formu[pass]"  id="valor"
               

               value="<?php
               if(isset($_POST['formu']['pass'])
                   &&$_POST['formu']['pass']!=null){
                   echo $_POST['formu']['pass'];
               }
               ?>">
          <br/>
          <input type="submit" name="formu[enviar]" value="Iniciar Sesion" class="button"/>
        </FORM>

          </div>
          
        </div>
      </section>
    </div>
        
</div>

</center>

      <?php require_once('footer.php'); ?>

    <?php
}
?>
