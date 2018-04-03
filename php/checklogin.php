<?php
session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head> 
<body width="100%" background="../ima/fondo.jpg">
 <center>
<?php
include("conexion.inc");
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM cuentas_usuarios WHERE usuario = '$username' and clave='$password' ";
 $result = $link->query($sql);
if ($result->num_rows > 0) {  
$fila = mysqli_fetch_array($result);
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
   $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (720* 60); //12horas
$vSql = "INSERT INTO logueos_usuarios (fecha_hora, id_cuenta, fecha_hora_out)
values (NOW(), ".$fila['id_cuenta'].", NOW())";
$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));

 if( $fila['tipo_usuario']=='Administrador')
{ ?>
	<script>
	location.href="../inicioAdministrador.php";
</script>
 <?php } else {
 if ( $fila['tipo_usuario']=='Usuario') 
{ ?>
	<script>
	location.href="../inicioUsuario.php";
</script> 
<?php   }
else {if($fila['tipo_usuario']=='Persona Egreso'){echo "<br><a href='../login.html'>Volver a Intentarlo</a>";echo "PERSONA NO AUTORIZADA.";}}}}
  else {  echo "Usuario o Clave estan INCORRECTOS.";echo "<br><a href='../login.html'>Volver a Intentarlo</a>";}
  mysqli_close($link);
?></center>
</body>
</html>