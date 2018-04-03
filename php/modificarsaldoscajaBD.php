<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
$e = $_POST['e'];
$c = $_POST['c'];
$o = $_POST['o'];
$ec = $_POST['ec'];


//Arma la instrucción SQL y luego la ejecuta

$vSql = "UPDATE cajas set saldo_efectivo='$e', saldo_cheques='$c', saldo_otros='$o', saldo_ec='$ec' where id_caja=1";
mysqli_query($link,$vSql);
echo("Saldos modificados<br>");

// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>
