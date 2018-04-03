<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head> <body>
<?php

include("conexion.inc");
//Captura datos desde el Form anterior
session_start();
$vNum = $_POST['Num'];
$vImporte = $_POST['Importe'];
$vFechaV = $_POST['FechaV'];
$vEstado = $_POST['Estado'];
$vid = $_POST['id'];

$vSql = "SELECT * FROM servicios  WHERE  id_prestacion='$vid'";
$RR=mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantID = mysqli_fetch_assoc($RR);

if($vCantID!=0){

$vSql = "SELECT idcuotas_clientes FROM cuotas_clientes  WHERE nro_cuota='$vNum' and id_prestacion='$vid' and fecha_vencimiento='$vFechaV'";
$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantUsuarios = mysqli_fetch_assoc($vResultado);


//$vCantUsuarios = mysqli_result($vResultado, 0);
if ($vCantUsuarios !=0){
 echo "<script>alert('La cuota ya fue registrada anteriormente!');</script>";}
 else {


$vSql = "INSERT INTO cuotas_clientes (nro_cuota, importe, fecha_vencimiento, estado, id_prestacion)
values ('$vNum', '$vImporte','$vFechaV','$vEstado','$vid')";
 mysqli_query($link, $vSql);


$vSql = "SELECT importe
FROM cuotas_clientes  
where estado='no paga' and id_prestacion='$vid'";
$vR = mysqli_query($link, $vSql);
$saldo=0;
while ($fila = mysqli_fetch_array($vR))
{$saldo=$saldo+$fila['importe'];} 

 $vSql = "update cuotas_clientes set saldo='$saldo' where id_prestacion='$vid'";
//and nro_cuota='$vNum' and fecha_vencimiento='$vFechaV'  ??
 mysqli_query($link, $vSql) or die (mysqli_error($link));


  
 echo "<script>alert('La cuota se registró con éxito');</script>";}} 
 else { echo "<script>alert('El Id Prestacion no fue cargado en REGISTRAR SERVICIO o dato incorrecto!!');</script>";}
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="altacuota.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Ualtacuota.php";
</script>
<?php }
 
 //header('Location: ../registrarcuenta.html');
 
 
 // Liberar conjunto de resultados
//mysqli_free_result($vResultado);


mysqli_close($link);
?>


</body>
</html>