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
  <form id="form1" name="form1" method="post" action="modificacionegreso.php" >
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<div class="col-md-offset-2 col-md-8">
  <div class="col-md-offset-2 col-md-8">
    <p>
      <?php
include("conexion.inc");

$vSql = "SELECT cu.apellido_cuenta as apellido_cliente, cu.nombre_cuenta as nombre_cliente, mo.tipo as tipo, mo.fecha as fecha, mo.id_movimientocaja, mo.monto as monto, mo.forma_movimiento as forma_movimiento, mo.motivo as motivo, mo.observacion as observacion, mo.id_caja
FROM movimientos_caja mo 
inner join cuentas_usuarios cu on mo.id_cuenta=cu.id_cuenta 
order by id_movimientocaja desc";

$vResultado = mysqli_query($link, $vSql);

?>
      <center>
       <br><br><br><br><br>
<div class="centrar">
<div style: text-align="center">
  <h3>Listado de egresos de caja</h3> </p> <br>
 <div id="tablaimprimir">
  <table  border=1 bordercolor="#3BB3DD"  width="800"   margin: 0 auto >
  
  <br>
  
    

        <tr>
             <td width="50px"><b><center>Fecha</center></b></td>
             <td width="50px"><b><center>Apellido</center></b></td>
             <td width="50px"><b><center>Nombre</center></b></td>
         
         
             <td width="50px"><b><center>Motivo</center></b></td>
            <td width="50px"><b><center>Observacion</center></b></td>
             <td width="50px"><b><center>Monto</center></b></td>
             <td width="50px"><b><center>Forma</center></b></td>
            <td width="50px"><b><center>Movimiento</center></b></td>
            
       
        </tr>
        <?php
while ($fila = mysqli_fetch_array($vResultado))
{
?>
        <tr>
        <td width="50px"><?php echo ($fila['fecha']); ?></td>
      <td width="50px"><?php echo ($fila['apellido_cliente']); ?></td>
          <td width="50px"><?php echo ($fila['nombre_cliente']); ?></td>
     
      
        
          <td width="50px"><?php echo ($fila['motivo']); ?></td>
           <td width="50px"><?php echo ($fila['observacion']); ?></td>
         
             <td width="50px"><?php echo ($fila['monto']); ?></td>
              <td width="50px"><?php echo ($fila['forma_movimiento']); ?></td>
                <td width="50px"><?php echo ($fila['tipo']); ?></td>
        
  
               
        
           
      
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