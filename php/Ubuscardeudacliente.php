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
	  
   
    alert('[ERROR] Debe seleccionar un cliente'); 
    return false;}
	 return true;
  }
</script>
</head>
<body width="100%" background="../ima/fondo.jpg">
<?php 
include("conexion.inc");
$vSql = "SELECT DISTINCT c.apellido_cliente, c.nombre_cliente, c.id_cliente FROM clientes c inner join servicios s on c.id_cliente=s.id_cliente 
inner join cuotas_clientes cu on s.id_prestacion=cu.id_prestacion where cu.estado='no paga' ORDER BY c.apellido_cliente ASC";
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
   <center> <form id="form1" name="form1" method="post" action="Umostrardeudascliente.php" onSubmit="return validacion()" >
      <p><h3>Cliente Deudor</h3></p>
      <p>&nbsp;</p>
      <p>
        
        <label for="textfield2">Apellido y Nombre:</label>
          <select  name="Cliente" id="Cliente" >
        <option value="">-Selecionar Cliente-</option>
  <?php while ($fila = mysqli_fetch_array($vResultado)) {
    echo "<option value='".$fila["id_cliente"]."'>".$fila['apellido_cliente']." ".$fila['nombre_cliente']."</option>"; 
 } ?>
        </select>
        
        
       
      </p>
      <p>&nbsp;</p>
      <p>
        <input type="submit" href="Umostrardeudascliente.php" name="button" id="button" value="Buscar">
        <a href="../inicioUsuario.php">   <input type="button"  name="Salir" id="Salir" value="Salir"></A>
      </p>
    </form></center>
    <p>&nbsp;</p>
    <div class="col-md-offset-2 col-md-8">
      
    </div>
  </div>
  <hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<?php // Liberar conjunto de resultados
mysqli_free_result($vResultado);

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>
