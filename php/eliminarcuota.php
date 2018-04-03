<html>
<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_GET['id_cc'];

$vSql = "SELECT*FROM cuotas_clientes WHERE idcuotas_clientes=".$vID;
$vResultado = mysqli_query($link, $vSql);
if(mysqli_num_rows($vResultado) == 0)
 {
echo "<script>alert('[ERROR] Cuota inexistente');</script>";
}
else{
//Arma la instrucción SQL y luego la ejecuta


//if (!$link->Execute(" CALL eliminar_cuota(IN ".$vID."  INT) ")) {
  //  echo "Falló la llamada el procedimiento almacenado";}


$result = $link-> query("CALL eliminar_cuota(".$vID.")");


if (! $result)
{
echo "error de procedure";
exit;
}


//inner join movimientos_caja mc on cc.idcuotas_clientes= mc.idcuotas_clientes 

echo "<script>alert('Cuota eliminada con éxito');</script>";
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

}







// Liberar conjunto de resultados
mysqli_free_result($vResultado);
// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>