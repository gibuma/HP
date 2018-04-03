<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
include("conexion.inc");
session_start();
//Captura datos desde el Form anterior
$vIDPrestacion = $_POST['IdPrestacion'];
$vTipo = $_POST['Tipo'];
$vEmpresa = $_POST['Empresa'];
$vRamo = $_POST['Ramo'];
$vPlan = $_POST['Plan'];
$vFormaPago = $_POST['FormaPago'];
$vCliente = $_POST['Cliente'];
settype($vCliente,"integer");
//Arma la instrucción SQL y luego la ejecuta
$vSql = "SELECT id_prestacion FROM servicios WHERE id_prestacion=$vIDPrestacion";
$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantUsuarios = mysqli_fetch_assoc($vResultado);
//$vCantUsuarios = mysqli_result($vResultado, 0);
if ($vCantUsuarios !=0){
 echo "<script>alert('[ERROR]Servicio ya fue registrado anteriormente!')</script>";}
 else {$vSql = "INSERT INTO servicios (id_prestacion, tipo_servicio, empresa, ramo, plan, forma_pago, id_cliente)
values ('$vIDPrestacion','$vTipo', '$vEmpresa', '$vRamo', '$vPlan', '$vFormaPago', '$vCliente')";
mysqli_query($link, $vSql);
$vSql = "INSERT INTO servicios_clientes (id_prestacion,id_cliente) values ('$vIDPrestacion', '$vCliente')";
 mysqli_query($link, $vSql) or die (mysqli_error($link));
 echo "<script>alert('Servicio registrado con éxito')</script>";}
 
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="altaservicios.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Ualtaservicios.php";
</script>
<?php }
  
// Cerrar la conexion
mysqli_close($link);
?>

</body>
</html>