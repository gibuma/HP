<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
   echo "No autorizado, necesita loguearse.<br>";
   echo "<br><a href='login.html'>Login</a>";
   exit;
}
$now = time();
if($now > $_SESSION['expire']) {
session_destroy();
echo "Su sesion a terminado,
<a href='login.html'>Necesita loguearse</a>";
exit();
}
if ($_SESSION['tipo_usuario'] == "Usuario") {
} else {
   echo "No autorizado para ésta sección!!!<br>";
   echo "<br><a href='login.html'>Login</a>";
   exit;
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
<link href="css/bootstrap.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body background="ima/img1.jpg">
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">Sistema de Gestión</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <!-- este es el menu principal-->
      <ul class="nav navbar-nav">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clientes<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="Uregistrarnuevocliente.php">Registrar Nuevo</a></li>
            <li><a href="php/Umostrarclientes.php">Mostrar</a></li>
            <li><a href="#">Servicios</a></li> 
            	<ul>
                      				  <li><a href="php/Ualtaservicios.php">Registrar</a>
                      <li><a href="php/Umostrarservicios.php">Mostrar</a>                                         
                </ul>            
          </ul>
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cuotas<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="php/Ualtacuota.php">Registrar</a></li>
            <li><a href="php/Umostrarcuotas.php">Mostrar</a></li>     
                     </ul>
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Caja<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="php/Ualtaegreso.php">Registrar Egreso</a></li>
            <li><a href="php/Ualtaingreso.php">Registrar Ingreso</a></li>
            <li><a href="php/Umostrarcaja.php">Mostrar</a></li>
            <li><a href="php/Umostrardeudas.php">Deudas</a></li> 
          </ul>
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pólizas<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="php/Ualtaalta.php">Alta</a></li>
            <li><a href="php/Ualtabaja.php">Baja</a></li>
            <li><a href="php/Umostrarpolizas.php">Mostrar</a></li>        
           		</li>
        </ul>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cuentas<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="Uregistrarcuenta.php">Registrar</a></li>
            <li><a href="php/Umostrarcuentas.php">Mostrar</a></li>              
		</li>
        </ul>
      </ul>  
                </ul>
          <ul class="nav navbar-nav navbar-right">
        <li><a href=""></a></li>
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['username'] ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
                       <li><a href=php/logout.php>Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container-fluid" >
  <div class="row">
  <center><img style= "width:100%" src="ima/logo oficina5.jpg"></center>
    <div class="col-md-offset-2 col-md-8">
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