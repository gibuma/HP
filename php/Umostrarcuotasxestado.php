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
</head>
<script language="javascript">
function imprSelec(tablaimprimir)
{var ficha=document.getElementById(tablaimprimir);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();
}




</script>
<body>
<style type="text/css">
.centrar {
   height: 400px;
   width: 900px;
   margin-top: -100px;
   margin-left: -450px;
   left: 50%;
   top: 50%;
   position: absolute;
}
</style>
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
  </div>
  <hr>
  <form id="form1" name="form1" method="post" action="modificacioncuota.php">
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<div class="col-md-offset-2 col-md-8">
  <div class="col-md-offset-2 col-md-8">
    <p>
      <?php
include("conexion.inc");

$vSql = "SELECT cl.apellido_cliente, cl.nombre_cliente, cc.nro_cuota, cc.fecha_vencimiento, cc.importe, cc.estado, cc.saldo, cc.idcuotas_clientes, cc.id_prestacion, s.empresa, s.tipo_servicio 
FROM  cuotas_clientes cc
inner join servicios s on cc.id_prestacion=s.id_prestacion 
inner join clientes cl on s.id_cliente=cl.id_cliente  
order by cc.estado ,cc.fecha_vencimiento desc";
$vResultado = mysqli_query($link, $vSql);

?>
      <center>
<br><br><br><br><br>
   <div class="centrar">
<div style: text-align="center">
   <strong><h3>Listado de cuotas</h3></strong> <br>
 <div id="tablaimprimir">
    <a href="Umostrarcuotasxempresa.php"><input type="button" name="button2" id="button2" value="Por Empresa"></a>
  
    <a href="Umostrarcuotasxapellido.php"><input type="button"  name="button3" id="button3" value="Por Cliente"></a>
   <a href="Umostrarcuotas.php"><input type="button"  name="button3" id="button3" value="Por Vencimiento"></a>
    </p><br>
    <table  border=1 bordercolor="#3BB3DD"  width="800"   margin: 0 auto >
      <center>
        <tr>
           <td width="50px"><b><center>Fecha Vencimiento</center></b></td>
          <td width="50px"><b><center>Estado</center></b></td>
         <td width="50px"><b><center>Id Prestacion</center></b></td>
         <td width="50px"><b><center>Saldo Pendiente</center></b></td>
         <td width="50px"><b><center>Importe</center></b></td>
          <td width="50px"><b><center>Número cuota</center></b></td>
            <td width="50px"><b><center>Empresa</center></b></td>
            <td width="50px"><b><center>Servicio</center></b></td>
         
          <td width="50px"><b><center>Apellido</center></b></td>
            <td width="50px"><b><center>Nombre</center></b></td>
         
             
        </tr>
        <?php
while ($fila = mysqli_fetch_array($vResultado))
{
?>
        <tr>
           <td width="50px"><?php echo ($fila['fecha_vencimiento']); ?></td>
          <td width="50px"><?php echo ($fila['estado']); ?></td>
         <td width="50px"><?php echo ($fila['id_prestacion']); ?></td>
         <td width="50px"><?php echo ($fila['saldo']); ?></td>
          <td width="50px"><?php echo ($fila['importe']); ?></td>
          <td width="50px"><?php echo ($fila['nro_cuota']); ?></td>
            <td width="50px"><?php echo ($fila['empresa']); ?></td>
          <td width="50px"><?php echo ($fila['tipo_servicio']); ?></td>
          <td width="50px"><?php echo ($fila['apellido_cliente']); ?></td>
         <td width="50px"><?php echo ($fila['nombre_cliente']); ?></td>
            
            
          
           
      
        </tr>
        <tr> <a href="../inicio.html">
        
        </a></tr>
      </center>
      <?php
} 
// Liberar conjunto de resultados
mysqli_free_result($vResultado);
// Cerrar la conexion
mysqli_close($link);
?>
    </table>   </div> <br><br>
   <center><a href="../inicioUsuario.php">
     
     
         <input type="button"  name="Salir" id="Salir" value="Salir"></a>
          <a href="javascript:imprSelec('tablaimprimir')"><input type="button" value="Imprimir"></a></center>
  </form>  </div>  </div>
</div>

    <p>&nbsp;</p>
    <p align="center">   
  </div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>
