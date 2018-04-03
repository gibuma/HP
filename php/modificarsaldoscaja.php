<?php
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
  <center></center>
    <div class="col-md-offset-2 col-md-8">
       
     <form id="form1" name="form1" method="post" action="modificarsaldoscajaBD.php">
      <?php
include("conexion.inc");

$vSql = "SELECT * FROM cajas where id_caja=1";

$vResu = mysqli_query($link, $vSql);
$vResultado = mysqli_fetch_array($vResu);

?>
      <center> <p><h3>Caja Saldos</h3></p>
       <p>&nbsp;</p>
       <p>
         <label for="textfield">Efectivo:</label>
         <input type="text" name="e" id="e" value="<?php echo ($vResultado['saldo_efectivo']); ?>">
         <label for="textfield2"> Cheque:</label>
         <input type="text" name="c" id="c" value="<?php echo ($vResultado['saldo_cheques']); ?>">
         <br> <br>
         <label for="textfield3">
          Otros:</label>
         <input type="text" name="o" id="o" value="<?php echo ($vResultado['saldo_otros']); ?>">
         <label for="textfield4">Efectivo+Cheque:</label>
         <input type="text" name="ec" id="ec" value="<?php echo ($vResultado['saldo_ec']); ?>">
     </p>
       <p>&nbsp;</p>
       <p>

         <input type="submit" href="modificarsaldoscajaBD.php" name="button" id="button" value="Registrar">
          
          <a href="../inicioAdministrador.php"><input type="button"  name="Salir" id="Salir" value="Salir"></a></center>
       </p>
      </center>
     
     </form>
    </div>
  </div>
  <hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 

<script src="js/bootstrap.js"></script>
</body>
</html>
