﻿<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


} else {

   echo "No autorizado, necesita loguearse.<br>";

   echo "<br><a href='../login.html'>Login</a>";
   
exit();
}

$now = time();
if($now > $_SESSION['expire']) {

session_destroy();
echo "Su sesion a terminado,
<a href='../login.html'>Necesita loguearse</a>";
exit();
}

if ($_SESSION['tipo_usuario'] == "Administrador") {


} else {

   echo "No autorizado para ésta sección!!!<br>";

   echo "<br><a href='../login.html'>Login</a>";
   
exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<title>Gestión de Oficina - Cañada Rica</title>

<!-- Bootstrap -->
<link href="../css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">

function validacion() {
if (document.getElementById("Apellido").value == null || document.getElementById("Apellido").value == 0 || /^\s+$/.test(document.getElementById("Apellido").value)) {
   
    alert('[ERROR] Apellido no puede estar vacío');
    return false;
  }
  else if (document.getElementById("Nombre").value == null || document.getElementById("Nombre").value == 0 || /^\s+$/.test(document.getElementById("Nombre").value)) {
    
    alert('[ERROR] Nombre no puede estar vacío');
    return false;
  }

  
	
	
  
 
  
  return true;
  }
  
  
</script>
</head>
<body width="100%" background="../ima/fondo.jpg">
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">Sistema de Gestión</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <!-- este es el menu principal-->
     
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container-fluid">
  <div class="row">
  <center>
    <form id="altaclientesform" action="modificarclienteBD.php" name="modiclientesform" method="post" onsubmit="return validacion()">
    <?php
include("conexion.inc");

$vf= $_POST['fi'];

$vSql = "SELECT id_cliente, apellido_cliente, nombre_cliente, dni, email_cliente, cuentas_bancarias, otros_datos FROM clientes where $vf=id_cliente";

$vResu = mysqli_query($link, $vSql);
$vResultado = mysqli_fetch_array($vResu);

?>
      <p><h3>Cliente:</h3></p>
      <p>
        <label for="textfield">
        <label></label>
        <br>
       
        <strong>Apellido</strong>:
  </label>
 <input name="Apellido" type="text" id="Apellido" value="<?php echo ($vResultado['apellido_cliente']); ?>" >
  <label for="textfield2">Nombre:</label>
  <input name="Nombre" type="text" id="Nombre" value="<?php echo ($vResultado['nombre_cliente']); ?>" >
  
      </p>
      <p>&nbsp;</p>
      <p>
        <label for="textfield">Dni:</label>
        <input type="text" name="Dni" id="Dni" value="<?php echo ($vResultado['dni']); ?>">
        <label for="textfield2">Email:</label>
        <input type="text" name="Email" id="Email" value="<?php echo ($vResultado['email_cliente']); ?>">
        <label for="textfield3">Cuentas Bancarias:</label>
        <input type="text" name="Cuentas" id="Cuentas" value="<?php echo ($vResultado['cuentas_bancarias']); ?>">
        <label for="textfield4">Otros datos:</label>
        <input type="text" name="Otros" id="Otros" value="<?php echo ($vResultado['otros_datos']); ?>">
        <input  name="id_cli" type="hidden" id="id_cli" value="<?php echo ($vResultado['id_cliente']); ?>" >
          
         
      </p>
      <p>&nbsp;</p>
      <p>
        <input type="submit" href="modificarclienteBD.php" name="Agregar" id="Agregar" value="Registrar">
       <a href="../inicioAdministrador.php">   <input type="button"  name="Salir" id="Salir" value="Salir"></a>
      </p>
    </form>
    <p>&nbsp;</p>
  </center>
    <div class="col-md-offset-2 col-md-8"></div>
  </div>
  <hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
