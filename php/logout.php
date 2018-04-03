<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<?php

session_start();
include("conexion.inc");

$usuactual=$_SESSION['username'];
$vSql = "select id_cuenta from cuentas_usuarios where usuario='$usuactual'";
$result = mysqli_query($link, $vSql) or die (mysqli_error($link));
$fila = mysqli_fetch_array($result);

$vSql = "select MAX(id_logueo) as id from logueos_usuarios where id_cuenta=".$fila['id_cuenta']."";
$re = mysqli_query($link, $vSql) or die (mysqli_error($link));
$max = mysqli_fetch_array($re);

$vSql = "UPDATE logueos_usuarios set fecha_hora_out=NOW() where id_cuenta=".$fila['id_cuenta']." and id_logueo=".$max['id']."";
mysqli_query($link, $vSql) or die (mysqli_error($link));


$_SESSION['loggedin'] = false;
unset ($usuactual);

session_destroy();
 
header('Location: ../login.html');



 ?>

<body>
</body>
</html>

