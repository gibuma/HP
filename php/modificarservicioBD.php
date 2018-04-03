<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_POST['id_ser'];

$vIDPrestacion = $_POST['IdPrestacion'];
$vTipo = $_POST['Tipo'];
$vEmpresa = $_POST['Empresa'];
$vRamo = $_POST['Ramo'];
$vPlan = $_POST['Plan'];
$vFormaPago = $_POST['FormaPago'];

//Arma la instrucción SQL y luego la ejecuta
$vSql = "UPDATE servicios s inner join servicios_clientes as sc on s.id_prestacion=sc.id_prestacion inner join clientes as c on c.id_cliente=sc.id_cliente
set s.id_prestacion='$vIDPrestacion', s.tipo_servicio='$vTipo', s.empresa='$vEmpresa', s.ramo='$vRamo', s.plan='$vPlan', s.forma_pago='$vFormaPago'  where sc.idservicios_clientes='$vID'";
mysqli_query($link,$vSql) or die (mysqli_error($link));
$vSql = "UPDATE servicios_clientes set id_prestacion='$vIDPrestacion' where idservicios_clientes='$vID'";
mysqli_query($link,$vSql);


echo "<script>alert('Servicio modificado con éxito');</script>";
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="mostrarservicios.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umostrarservicios.php";
</script>
<?php }

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>