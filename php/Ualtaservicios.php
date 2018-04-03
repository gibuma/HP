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

if ($_SESSION['tipo_usuario'] == "Usuario") {


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
if( (document.getElementById("Cliente").selectedIndex) == null || (document.getElementById("Cliente").selectedIndex) == 0 )
    {
	  
   
    alert('[ERROR] Debe seleccionar un Cliente'); 
    return false;}
 
	
  
   else if (document.getElementById("IdPrestacion").value == null || document.getElementById("IdPrestacion").value == 0 || /^\s+$/.test(document.getElementById("IdPrestacion").value)) {
    
    alert('[ERROR] Id Prestacion no puede estar vacío');
    return false;
  }
else if( (document.getElementById("Tipo").selectedIndex) == null || (document.getElementById("Tipo").selectedIndex) == 0 )
    {
	  
   
    alert('[ERROR] Debe seleccionar un servicio'); 
    return false;}
else if( (document.getElementById("Empresa").selectedIndex) == null || (document.getElementById("Empresa").selectedIndex) == 0 )
    {
	  
   
    alert('[ERROR] Debe seleccionar una empresa'); 
    return false;}
else if( (document.getElementById("Ramo").selectedIndex) == null || (document.getElementById("Ramo").selectedIndex) == 0 )
    {
	  
   
    alert('[ERROR] Debe seleccionar un ramo'); 
    return false;}


   else if (document.getElementById("Plan").value == null || document.getElementById("Plan").value == 0 || /^\s+$/.test(document.getElementById("Plan").value)) {
    
    alert('[ERROR] Plan no puede estar vacío');
    return false;
  }

   else if (document.getElementById("FormaPago").value == null || document.getElementById("FormaPago").value == 0 || /^\s+$/.test(document.getElementById("FormaPago").value)) {
    
    alert('[ERROR] Forma Pago no puede estar vacío');
    return false;
  }
  
  
 
  
  return true;
  }
</script>
</head>
<body width="100%" background="../ima/fondo.jpg">
<?php 
include("conexion.inc");
$vSql = "SELECT apellido_cliente, nombre_cliente, id_cliente FROM clientes ORDER BY apellido_cliente ASC";
$vResultado = mysqli_query($link, $vSql);

$total_registros=mysqli_num_rows($vResultado);

?>


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
  <center> <form id="regserviciosform" action="altaserviciosBD.php" name="regserviciosform" method="post" onSubmit="return validacion()">
  <h3>Servicios</h3> </p>
      <p>&nbsp;</p>
      

     <label for="textfield2">Apellido y Nombre:</label>
          <select  name="Cliente" id="Cliente" >
        <option value="">-Selecionar Cliente-</option>
  <?php while ($fila = mysqli_fetch_array($vResultado)) {
    echo "<option value='".$fila["id_cliente"]."'>".$fila['apellido_cliente']." ".$fila['nombre_cliente']."</option>"; 
 } ?>
        </select>
          <label for="textfield3">Id Prestación:</label>
        <input name="IdPrestacion" type="text" id="IdPrestacion" >
         
         <label for="Tipo">Servicio:</label>
        <select type="text" name="Tipo" id="Tipo">
        <option value="">Seleccionar</option>
          <option>Seguro</option>
          <option>Obra Social</option>
        </select>
        <label for="textfield2">Empresa:</label>
        <select type="text" name="Empresa" id="Empresa">
        <option value="">Seleccionar</option>
           <option value="Sancor Seguros">Sancor Seguros</option>
          <option value="Mercantil Andina Seguros">Mercantil Andina Seguros</option>
          <option value="Rivadavia Seguros">Rivadavia Seguros</option>
          <option value="Federada Salud">Federada Salud</option>
        </select>
    
        <br> <br> <label for="textfield4"><br>
         
          Ramo:</label>
        <select type="text" name="Ramo" id="Ramo">
           <option >Seleccionar</option>
          <option value="Accidentes Personas">Accidentes Personales</option>
          <option value="Automotores">Automotores</option>
          <option value="Casco- Embarcaciones">Casco- Embarcaciones</option>
          <option value="Caución">Caución</option>
          <option value="Combinado Familiar">Combinado Familiar</option>
          <option value="Granizo">Granizo</option>
          <option value="Incendio">Incendio</option>
          <option value="Integral para comercio">Integral para comercio</option>
          <option value="Motovehículos">Motovehículos</option>
          <option value="Responsabilidad civil">Responsabilidad civil</option>
          <option value="Riesgo de trabajo">Riesgos de trabajo</option>
          <option value="Robo">Robo</option>
          <option value="Salud">Salud</option>
          <option value="Seguro Integral">Seguro Integral</option>
          <option value="Seguro Técnico">Seguro Técnico</option>
          <option value="Transporte">Transporte</option>
          <option value="Vida Colectivo">Vida Colectivo</option>
          <option value="Vida Individual">Vida Individual</option>
          <option value="Vida Obligatorio">Vida Obligatorio</option>
        </select>
        <label for="textfield5">Plan:</label>
        <input name="Plan" type="text" id="Plan" >
        <label for="textfield6">Forma de pago:</label>
        <input name="FormaPago" type="text" id="FormaPago" >
         
      </p>
      <p>&nbsp;</p>
      <p>
        <input type="submit" href="altaserviciosBD.php" name="button" id="button" value="Agregar">
       <a href="../inicioUsuario.php">   <input type="button"  name="Salir" id="Salir" value="Salir"></A>
      </p>
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
