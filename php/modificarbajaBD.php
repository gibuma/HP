<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_POST['id_m'];

$vFecha = $_POST['Fecha'];
$vEstado = $_POST['Estado'];
$vFechaV = $_POST['FechaV'];
$vId = $_POST['Id'];

$vSql = "SELECT * FROM servicios  WHERE  id_prestacion='$vId'";
$RR=mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantID = mysqli_fetch_assoc($RR);
$vSql = "SELECT id_movimientopoliza FROM movimientos_poliza WHERE id_prestacion=$vId and tipo='alta'";
$vAL= mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantAL = mysqli_fetch_assoc($vAL); 
if($vCantID!=0 and $vCantAL=!0)
{$vSql = "SELECT id_movimientopoliza FROM movimientos_poliza WHERE id_prestacion=$vId and tipo='baja' and fecha_vigencia='$vFechaV' and id_movimientopoliza not in
(SELECT id_movimientopoliza FROM movimientos_poliza WHERE id_movimientopoliza='$vID')";

$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantUsuarios = mysqli_fetch_assoc($vResultado); 
   if ($vCantUsuarios !=0){echo "<script>alert('[ERROR] La baja ya fue registrada anteriormente!!')</script>";}
   else {

$vSql = "UPDATE movimientos_poliza set fecha='$vFecha', estado='$vEstado', fecha_vigencia='$vFechaV', id_prestacion='$vId', tipo='baja' where 
id_movimientopoliza='$vID'";
mysqli_query($link,$vSql);
echo "<script>alert('La baja se modificó con éxito')</script>";
}
 } 
 else {	 echo "<script>alert('El Id Prestacion no fue cargado en REGISTRAR SERVICIO/ No se cargó el ALTA de la misma/ Dato incorrecto!!')</script>"; }
 
if ($_SESSION['tipo_usuario'] == "Administrador"){ ?>
<script>
location.href="modificacionbajaprevia.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umodificacionbajaprevia.php";
</script>
<?php }

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>