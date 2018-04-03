<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>

<?php
include("conexion.inc");
session_start();
//Captura datos desde el Form anterior
$vNombre = $_POST['Nombre'];
$vApellido = $_POST['Apellido'];
$vDni = $_POST['Dni'];
$vEmail = $_POST['Email'];
$vCuentas = $_POST['Cuentas'];
$vOtros = $_POST['Otros'];

if($vDni=='Opcional')
{$vDni='null';}
if($vEmail =='Opcional'){$vEmail ='';}
if($vCuentas=='Opcional'){$vCuentas='';}
if($vOtros=='Opcional'){$vOtros='';}



//Arma la instrucción SQL y luego la ejecuta
$vSql = "SELECT apellido_cliente, nombre_cliente FROM clientes WHERE nombre_cliente='$vNombre' and apellido_cliente='$vApellido'";

$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));

$vCantUsuarios = mysqli_fetch_assoc($vResultado);


//$vCantUsuarios = mysqli_result($vResultado, 0);
if ($vCantUsuarios !=0){
echo "<script>alert('[ERROR ]El cliente ya se registro anteriorimente');</script>";}
 else {
$vSql = "INSERT INTO clientes (nombre_cliente, apellido_cliente, dni, email_cliente, cuentas_bancarias, otros_datos)
values ('$vNombre','$vApellido','$vDni','$vEmail','$vCuentas','$vOtros')";
 mysqli_query($link, $vSql) or die (mysqli_error($link));

echo "<script>alert('El cliente se registró con éxito');</script>";}
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="../registrarnuevocliente.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="../Uregistrarnuevocliente.php";
</script>
<?php }
 

  
 
 
// Liberar conjunto de resultados
mysqli_free_result($vResultado);

// Cerrar la conexion
mysqli_close($link);
?>

</body>
</html>