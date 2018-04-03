<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head> <body>
<?php
include("conexion.inc");
//Captura datos desde el Form anterior
session_start();
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
{$vSql = "SELECT id_movimientopoliza FROM movimientos_poliza WHERE id_prestacion=$vId and tipo='baja' and fecha_vigencia='$vFechaV'";

$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantUsuarios = mysqli_fetch_assoc($vResultado); 
   if ($vCantUsuarios !=0){echo "<script>alert('[ERROR] La baja ya fue registrada anteriormente!!')</script>";}
   else { $vSql = "INSERT INTO movimientos_poliza (fecha, estado, fecha_vigencia, id_prestacion, tipo) values ('$vFecha', '$vEstado','$vFechaV','$vId','baja')";
          mysqli_query($link, $vSql) or die (mysqli_error($link));
     	  echo "<script>alert('La baja se registró con éxito')</script>"; 
		 }
 } 
 else {	 echo "<script>alert('El Id Prestacion no fue cargado en REGISTRAR SERVICIO/ No se cargó el ALTA de la misma/ Dato incorrecto!!')</script>"; }

if ($_SESSION['tipo_usuario'] == "Administrador"){ ?>
<script>
location.href="altabaja.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Ualtabaja.php";
</script>
<?php }
 
 
// Liberar conjunto de resultados
mysqli_free_result($vResultado);
mysqli_close($link);
?>

</body>
</html>