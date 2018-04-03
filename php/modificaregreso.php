<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


} else {

   echo "No autorizado, necesita loguearse.<br>";

   echo "<br><a href='../login.html'>Login</a>";
   
exit;
}

$now = time();
if($now > $_SESSION['expire']) {

session_destroy();
echo "Su sesion a terminado,
<a href='../login.html'>Necesita loguearse</a>";
exit();
}

if ($_SESSION['tipo_usuario'] == "Administrador") {


} else {

   echo "No autorizado para ésta sección!!!<br>";

   echo "<br><a href='../login.html'>Login</a>";
   
exit;
}

?>
<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
$vID = $_POST['id_cc'];

$vNum = $_POST['Num'];
$vImporte = $_POST['Importe'];
$vFechaV = $_POST['FechaV'];
$vEstado = $_POST['Estado'];
$vid = $_POST['id'];

//Arma la instrucción SQL y luego la ejecuta
//$vSql = "UPDATE cuotas c inner join cuotas_clientes cc on c.id_prestacion=cc.id_prestacion and c.nro_cuota=cc.nro_cuota 
//set c.nro_cuota='$vNum', c.importe='$vImporte', c.fecha_vencimiento='$vFechaV', c.estado='$vEstado ', c.id_prestacion='$vid'  where cc.idcuotas_clientes='$vID' and c.fecha_vencimiento=cc.fecha_vencimiento";
//mysqli_query($link,$vSql) or die (mysqli_error($link));
//$vSql = "UPDATE cuotas_clientes set id_prestacion='$vid', fecha_vencimiento='$vFechaV' where idcuotas_clientes='$vID'";
//mysqli_query($link,$vSql);
echo("modificaregreso.php borrar pagina<br>");

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>