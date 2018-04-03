<head>
<title></title>
</head>
<body>
<?php
session_start();
include ("conexion.inc");
$vID = $_POST['id_m'];

$vFecha = $_POST['Fecha']; 
//$vMonto = $_POST['Monto']; 
//$vForma = $_POST['Forma']; 
$vMotivo = $_POST['Motivo']; 
$vObs = $_POST['Obs']; 
$vCuenta =$_POST['Cuenta']; 

settype($vCuenta,"integer");


//Arma la instrucción SQL y luego la ejecuta
$vSql = "UPDATE movimientos_caja set fecha='$vFecha', tipo='egreso', motivo='$vMotivo', observacion='$vObs', id_caja=1, id_cuenta='$vCuenta' where id_movimientocaja='$vID'";
mysqli_query($link,$vSql);

 echo "<script>alert('El egreso se modificó con éxito')</script>";

 if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="modificacionegresoprevia.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umodificacionegresoprevia.php";
</script>
<?php }

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>