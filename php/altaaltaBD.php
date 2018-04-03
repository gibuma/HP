<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head> <body>
<?php
session_start();
include("conexion.inc");
//Captura datos desde el Form anterior

$vFecha = $_POST['Fecha'];
$vEstado = $_POST['Estado'];
$vFechaV = $_POST['FechaV'];
$vId = $_POST['Id'];
$vPatente = $_POST['Patente'];
$vAP = $_POST['AP'];
$vEdificio = $_POST['Edificio'];
$vAsegurado = $_POST['Asegurado'];

if($vPatente=='Opcional'){$vPatente='';}
if($vAP=='Opcional'){$vAP='';}
if($vEdificio=='Opcional'){$vEdificio='';}
if($vAsegurado=='Opcional'){$vAsegurado='';}


$vSql = "SELECT * FROM servicios  WHERE  id_prestacion='$vId'";
$RR=mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantID = mysqli_fetch_assoc($RR);
if($vCantID!=0){

$vSql = "SELECT id_movimientopoliza FROM movimientos_poliza WHERE id_prestacion=$vId and tipo='alta' and fecha_vigencia=$vFechaV";
$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantUsuarios = mysqli_fetch_assoc($vResultado);



//$vCantUsuarios = mysqli_result($vResultado, 0);
if ($vCantUsuarios !=0){
 echo ("El alta ya fue registrada anteriormente!!<br>");}
 else {
$vSql = "INSERT INTO movimientos_poliza (fecha, estado, fecha_vigencia, id_prestacion, patente, asegurado, edificio_riesgo, AP, tipo)
values ('$vFecha', '$vEstado','$vFechaV','$vId','$vPatente', '$vAsegurado', '$vEdificio' ,'$vAP', 'alta')";

 mysqli_query($link, $vSql) or die (mysqli_error($link));

 echo "<script>alert('El alta se registró con éxito');</script>"; }} else {
	 echo "<script>alert('El Id Prestacion no fue cargado en REGISTRAR SERVICIO o dato incorrecto!!');</script>";
	 }

if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="altaalta.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Ualtaalta.php";
</script>
<?php }
 
 //header('Location: ../registrarcuenta.html');
 
// Liberar conjunto de resultados
mysqli_free_result($vResultado);


mysqli_close($link);
?>


</body>
</html>