<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_POST['id_cc'];

$vNum = $_POST['Num'];
$vImporte = $_POST['Importe'];
$vFechaV = $_POST['FechaV'];
$vEstado = $_POST['Estado'];
$vid = $_POST['id'];

$vSql = "SELECT * FROM servicios  WHERE  id_prestacion='$vid'";
$RR=mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantID = mysqli_fetch_assoc($RR);

if($vCantID!=0){

//Arma la instrucción SQL y luego la ejecuta
$vSql = "UPDATE  cuotas_clientes c 
set c.nro_cuota='$vNum', c.importe='$vImporte', c.fecha_vencimiento='$vFechaV', c.estado='$vEstado ', c.id_prestacion='$vid'  where c.idcuotas_clientes='$vID' ";
mysqli_query($link,$vSql) or die (mysqli_error($link));

 echo "<script>alert('La cuota se modificó con éxito');</script>";} 
 else { echo "<script>alert('El Id Prestacion no fue cargado en REGISTRAR SERVICIO o dato incorrecto!!');</script>";}
 if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="mostrarcuotas.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umostrarcuotas.php";
</script>
<?php }

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>