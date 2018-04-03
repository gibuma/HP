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
$vPatente = $_POST['Patente'];
$vAP = $_POST['AP'];
$vEdificio = $_POST['Edificio'];
$vAsegurado = $_POST['Asegurado'];

//Arma la instrucción SQL y luego la ejecuta

$vSql = "UPDATE movimientos_poliza set fecha='$vFecha', estado='$vEstado', fecha_vigencia='$vFechaV', id_prestacion='$vId', patente='$vPatente' , asegurado='$vAsegurado', edificio_riesgo='$vEdificio', AP='$vAP', tipo='alta' where id_movimientopoliza='$vID'";
mysqli_query($link,$vSql);
echo "<script>alert('El alta se modificó con éxito');</script>";

if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="modificacionaltaprevia.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umodificacionaltaprevia.php";
</script>
<?php }

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>