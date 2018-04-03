<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
session_start();

$vID = $_POST['id_c'];
$vNombre = $_POST['Nombre'];
$vApellido = $_POST['Apellido'];
$vTipo = $_POST['Tipo'];
$vUsuario = $_POST['Usuario'];
$vClave = $_POST['Clave'];
$vEmail = $_POST['Email'];

$vSql = "SELECT apellido_cuenta, nombre_cuenta FROM cuentas_usuarios WHERE nombre_cuenta='$vNombre' and apellido_cuenta='$vApellido'";
$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantUsuarios = mysqli_fetch_assoc($vResultado);
$vSql ="SELECT usuario FROM cuentas_usuarios WHERE usuario='$vUsuario' and usuario NOT IN(SELECT usuario FROM cuentas_usuarios where id_cuenta=".$vID.")";
$vResul = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantU = mysqli_fetch_assoc($vResul);

if ($vCantUsuarios !=0){
	
	
echo "<script>alert('[ERROR ]La cuenta ya se registró anteriormente');</script>";



 
}else { if ($vCantU !=0 and $vCantU['usuario']!=''){ echo "<script>alert('[ERROR ]El usuario ya existe, elija otra opcion');</script>";} else{
//Arma la instrucción SQL y luego la ejecuta
$vSql = "UPDATE cuentas_usuarios set nombre_cuenta='$vNombre', apellido_cuenta='$vApellido', tipo_usuario='$vTipo', email_usuario='$vEmail', usuario='$vUsuario', clave='$vClave' where id_cuenta='$vID'";
mysqli_query($link,$vSql);
echo "<script>alert('La cuenta se registró con éxito');</script>";}}
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
<?php }


// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>