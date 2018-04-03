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
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<title>Gestión de Oficina - Cañada Rica</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
function validacion() {
if(document.getElementById("Fecha").value == "aaaa-mm-dd" || !isNaN(document.getElementById("Fecha").value) )
    {	     
    alert('[ERROR] Fecha invalida'); 
    return false;}
	
  
   else if (document.getElementById("Id").value == null || document.getElementById("Id").value == 0 || /^\s+$/.test(document.getElementById("Id").value)) {
    
    alert('[ERROR] Id Prestacion no puede estar vacío');
    return false;
  }
else if( (document.getElementById("Estado").selectedIndex) == null || (document.getElementById("Estado").selectedIndex) == 0 )
    {
	  
   
    alert('[ERROR] Debe seleccionar un estado'); 
    return false;}
	
 else if(document.getElementById("FechaV").value == "aaaa-mm-dd" ||  !isNaN(document.getElementById("FechaV").value))
    {	     
    alert('[ERROR] Fecha invalida'); 
    return false;}
	
  
  
 
  
  return true;
  }
</script>
</head>
<body width="100%" background="../ima/fondo.jpg">

<nav class="css/navbar navbar-default">
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
  <br>
    <form id="form1" name="form1" method="post" action="altaaltaBD.php" onsubmit="return validacion()">
    
      <p><h3>Alta de pólizas </h3></p>
      <p>&nbsp;</p>
      <p>
        
        
        <label for="Fecha"><strong>Fecha:</label></strong>
        
        <input name="Fecha" type="text" id="Fecha"  value="aaaa-mm-dd">
       <strong> <label for="textfield5">Estado:</label></strong>
        <select type="text" name="Estado" id="Estado">
          <option value="">-Seleccionar-</option>
          <option value="emitido">Emitido</option>
          <option value="pendiente">Pendiente</option>
        </select>
        <label for="Id">Id Prestación:</label>
        <input name="Id" type="text" id="Id" >
        </p>
      <p>&nbsp;</p>
      <p>
        <label for="FechaV">Fecha vigencia:</label>
        <input name="FechaV" type="text" id="FechaV" value="aaaa-mm-dd">
        <strong>
        Patente/s
          <label for="Patente">:</label>
        </strong>
<input name="Patente" type="text" id="Patente" value="Opcional">
        <label for="Edificio">Edificio de riesgo:</label>
        <input name="Edificio" type="text" id="Edificio" value="Opcional">
        </p>
      <p>&nbsp;</p>
      <p><strong>AP
         <label for="AP">:</label></strong>
        
       <input name="AP" type="text" id="AP" value="Opcional">
      <strong>  <label for="Asegurado">Asegurado/s:</label></strong>
        <input name="Asegurado" type="text" id="Asegurado" value="Opcional">
      </p>
      <p>&nbsp;</p>
      <p>
        
        <input type="submit" href="altaaltaBD.php" name="button" id="button" title="Salir" value="Registrar">
        <a href="../inicioAdministrador.php">   <input type="button"  name="Salir" id="Salir" value="Salir">
        </A>        </p>
    </form>
    <p>&nbsp;</p>
  </center>
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
