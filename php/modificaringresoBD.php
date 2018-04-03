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


$vMotivo = $_POST['Motivo'];

$vObs = $_POST['Obs'];

//$vNum = $_POST['NumeroCuota'];

//$vid = $_POST['id'];
//$vForma=$_POST['Forma'];
//$vfechav = $_POST['fechav'];

//$vSql = "SELECT idcuotas_clientes from cuotas_clientes c 

//WHERE c.nro_cuota='$vNum' and c.id_prestacion='$vid' and c.fecha_vencimiento='$vfechav'";

//$vR = mysqli_query($link, $vSql) or die (mysqli_error($link));

//$vC = mysqli_fetch_assoc($vR);
// idcuotas_clientes=".$vC['idcuotas_clientes']."
//Arma la instrucción SQL y luego la ejecuta
$vSql = "UPDATE movimientos_caja set  fecha='$vFecha', tipo='ingreso',  motivo='$vMotivo', observacion='$vObs', id_caja=1 where id_movimientocaja='$vID'";
mysqli_query($link,$vSql);

 echo "<script>alert('El ingreso se modificó con éxito')</script>";
 
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="modificacioningresoprevia.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umodificacioningresoprevia.php";
</script>
<?php }

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>