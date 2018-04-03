<html>
<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_GET['id_ser'];


$vSql = "SELECT id_prestacion, id_cliente FROM servicios_clientes WHERE idservicios_clientes=".$vID;

$vResultado = mysqli_query($link, $vSql);

if(mysqli_num_rows($vResultado) == 0)
 {
echo "<script>alert('[ERROR] Servicio inexistente');</script>";
}
else{


//llama el stored procedure

$result = $link-> query("CALL eliminar_servicio(".$vID.")");


if (! $result)
{
echo "error de procedure";
exit;
}
 
echo "<script>alert('Servicio eliminado con éxito');</script>";}


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
<?php
} 
// Liberar conjunto de resultados
mysqli_free_result($vResultado);
// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>