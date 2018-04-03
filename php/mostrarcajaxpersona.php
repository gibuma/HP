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
<script>
function confirmarEliminar()
   {
var statusConfirm = confirm("¿Desea eliminarlo?");
if (statusConfirm == true)
{

}
else
{

location.href="mostrarcajaxpersona.php";
}

}
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
  <form id="form1" name="form1" method="post"  action="modificacioningreso.php">
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<div class="col-md-offset-2 col-md-8">
  <div class="col-md-offset-2 col-md-8">
    <p>
      <?php
include("conexion.inc");

$vSql = "(SELECT 
 c.apellido_cliente as apellido_cliente, c.nombre_cliente as nombre_cliente, m.tipo as tipo, m.fecha as fecha, m.id_movimientocaja, m.monto as monto, m.forma_movimiento as forma_movimiento, m.motivo as motivo, m.observacion as observacion, m.id_caja as caja, s.empresa as empresa, cuo.nro_cuota  as nro_cuota
FROM movimientos_caja m 
inner join servicios s on m.id_prestacion=s.id_prestacion 
inner join clientes c on s.id_cliente=c.id_cliente 
inner join cuotas_clientes cuo on m.idcuotas_clientes=cuo.idcuotas_clientes and m.id_prestacion=cuo.id_prestacion
where m.fecha_vencimiento=cuo.fecha_vencimiento )
-- order by m.id_movimientocaja desc
union
(SELECT cu.apellido_cuenta as apellido_cliente, cu.nombre_cuenta as nombre_cliente, mo.tipo as tipo, mo.fecha as fecha, mo.id_movimientocaja, mo.monto as monto, mo.forma_movimiento as forma_movimiento, mo.motivo as motivo, mo.observacion as observacion, mo.id_caja,'-' as empresa,'-' as nro_cuota
FROM movimientos_caja mo 
inner join cuentas_usuarios cu on mo.id_cuenta=cu.id_cuenta )
order by apellido_cliente desc;";

$vResultado = mysqli_query($link, $vSql);
$vSql = "select saldo_efectivo, saldo_cheques, saldo_otros, saldo_ec from cajas where id_caja=1";
$Re = mysqli_query($link, $vSql);
$R = mysqli_fetch_array($Re);

?>
      <center>
      <br><br><br><br><br>
     <div class="centrar">
<div style: text-align="center">
<div id="tablaimprimir">
  <strong><h3>Listado de movimientos de caja</h3></strong> 
 
     <a href="mostrarcajaxempresa.php"><input type="button" name="button2" id="button2" value="Por Empresa"></a>
    
    <a href="mostrarcajahoy.php">
       <input type="button"  name="button3" id="button3" value="Hoy"></a>
 
    <a href="mostrarcaja.php">
       <input type="button"  name="button3" id="button3" value="Todos"> </a>
<br>
    <br>

    <table  border=1 bordercolor="#3BB3DD"  width="800"   margin: 0 auto >
      <center>
        <tr>
          <td width="50px"><b><center>Fecha</center></b></td>
         <td width="50px"><b><center>Apellido</center></b></td>
          <td width="50px"><b><center>Nombre</center></b></td>
           <td width="50px"><b><center>Empresa</center></b></td>
          <td width="50px"><b><center>Cuota</center></b></td>
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
              <td width="50px"><?php echo ($fila['empresa']); ?></td>
          <td width="50px"><?php echo ($fila['nro_cuota']); ?></td>
                  <td width="50px"><?php echo ($fila['motivo']); ?></td>
           <td width="50px"><?php echo ($fila['observacion']); ?></td>
                      <td width="50px"><?php echo ($fila['monto']); ?></td>
               <td width="50px"><?php echo ($fila['forma_movimiento']); ?></td>
 <td width="50px"><?php echo ($fila['tipo']); ?></td>
          <td width="50px"><input type="button" style="color: #003366; background-color: #99CCFF" onclick="<?php echo "location.href='eliminarmovimientocaja.php?id_m=".$fila['id_movimientocaja']."'";?>, confirmarEliminar()" name="button" 
		   id="button" value="Eliminar" ></td>
      
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
       
 <b><font color="blue">Saldo efectivo:</font></b><?php echo ($R['saldo_efectivo']); ?>  <br>
 <b><font color="blue">Saldo cheques:</font></b><?php echo ($R['saldo_cheques']); ?> <br>
  <b><font color="blue">Saldo efectivo-cheques:</font></b> <?php echo ($R['saldo_ec']); ?><br><br>
    </table></div>  <br><br>
   

<center>
    
   <a href="modificacioningresoprevia.php">  <input type="button"   name="button" id="button" value="Modificar Ingreso" ></a>
  <a href="modificacionegresoprevia.php"> <input type="button"   name="button" id="button" value="Modificar Egreso" ></a>
  <a href="../inicioAdministrador.php"><input type="button"  name="Salir" id="Salir" value="Salir"></a>
  <a href="javascript:imprSelec('tablaimprimir')"><input type="button" value="Imprimir"></a></center>  </form></div></div>
</div>

    <p>&nbsp;</p>
    <p align="center">   
  </div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>
