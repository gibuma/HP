<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head> <body>
<?php
include("conexion.inc");
session_start();
//Captura datos desde el Form anterior

$vNombre = $_POST['Nombre'];
$vApellido = $_POST['Apellido'];
$vTipo = $_POST['Tipo'];
$vUsuario = $_POST['Usuario'];
$vClave = $_POST['Clave'];
$vEmail = $_POST['Email'];

if($vUsuario=='Opcional'){
$vUsuario='';}
if($vClave=='Opcional'){
$vClave='';}

if($vTipo=='Persona Egreso')
{$vUsuario='';
$vClave='';}

//Arma la instrucción SQL y luego la ejecuta
$vSql = "SELECT apellido_cuenta, nombre_cuenta FROM cuentas_usuarios WHERE nombre_cuenta='$vNombre' and apellido_cuenta='$vApellido'";
$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantUsuarios = mysqli_fetch_assoc($vResultado);
$vSql = "SELECT usuario FROM cuentas_usuarios WHERE usuario='$vUsuario'";
$vResul = mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantU = mysqli_fetch_assoc($vResul);

if ($vCantUsuarios !=0){
	
	
echo "<script>alert('[ERROR ]La cuenta ya se registró anteriormente');</script>";



 
}
else { if ($vCantU !=0 and $vCantU['usuario']!=''){ echo "<script>alert('[ERROR ]El usuario ya existe, elija otra opcion');</script>";} else{
$vSql = "INSERT INTO cuentas_usuarios(nombre_cuenta, apellido_cuenta, tipo_usuario, usuario, clave, email_usuario)
values ('$vNombre','$vApellido','$vTipo','$vUsuario','$vClave', '$vEmail')";
 mysqli_query($link, $vSql) or die (mysqli_error($link));


 
 
 echo "<script>alert('La cuenta se registró con éxito');</script>";}}
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="../registrarcuenta.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="../Uregistrarcuenta.php";
</script>
<?php }
 //header('Location: ../registrarcuenta.html');
 
 // Liberar conjunto de resultados
mysqli_free_result($vResultado);


mysqli_close($link);
?>


</body>
</html>