<html>
<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_GET['id_c'];

$vSql = "SELECT*FROM cuentas_usuarios WHERE id_cuenta='$vID' ";
$vResultado = mysqli_query($link, $vSql);
if(mysqli_num_rows($vResultado) == 0)
 {
 echo "<script>alert('Cuenta inexistente!');</script>";
}
else{
//Arma la instrucción SQL y luego la ejecuta
$vSql= "DELETE FROM cuentas_usuarios WHERE id_cuenta='$vID' ";
mysqli_query($link, $vSql);

 echo "<script>alert('La cuenta se elimino con éxito');</script>";



if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="mostrarcuentas.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umostrarcuentas.php";
</script>
<?php }}
// Liberar conjunto de resultados
mysqli_free_result($vResultado);
// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>