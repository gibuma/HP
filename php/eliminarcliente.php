<html>
<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();
$vID = $_GET['id_cli'];

$vSql = "SELECT*FROM clientes WHERE id_cliente='$vID' ";
$vResultado = mysqli_query($link, $vSql);
if(mysqli_num_rows($vResultado) == 0)
 {
echo "<script>alert('[ERROR ]El cliente inexistente');</script>";
}
else{
//Arma la instrucción SQL y luego la ejecuta
$vSql= "DELETE FROM clientes  WHERE id_cliente='$vID' ";
mysqli_query($link, $vSql);

 echo "<script>alert('El cliente fue Eliminado');</script>";
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="mostrarclientes.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Umostrarclientes.php";
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