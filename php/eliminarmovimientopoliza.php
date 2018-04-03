<html>
<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_GET['id_m'];

$vSql = "SELECT*FROM movimientos_poliza WHERE id_movimientopoliza='$vID' ";
$vResultado = mysqli_query($link, $vSql);
if(mysqli_num_rows($vResultado) == 0)
 {
	  echo "<script>alert('[ERROR] Movimiento Inexistente!');</script>";

}
else{
//Arma la instrucción SQL y luego la ejecuta
$vSql= "DELETE FROM movimientos_poliza WHERE id_movimientopoliza='$vID' ";
//mysqli_query($link, $vSql);

mysqli_query($link, $vSql);
 echo "<script>alert('Movimiento eliminado con éxito');</script>";}
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="mostrarpolizas.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umostrarpolizas.php";
</script>
<?php  

}
// Liberar conjunto de resultados
mysqli_free_result($vResultado);
// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>