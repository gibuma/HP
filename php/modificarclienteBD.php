<head>
<title></title>
</head>
<body>

<?php
include ("conexion.inc");
session_start();
$vID = $_POST['id_cli'];

$vNombre = $_POST['Nombre'];
$vApellido = $_POST['Apellido'];
$vDni = $_POST['Dni'];
$vEmail = $_POST['Email'];
$vCuentas = $_POST['Cuentas'];
$vOtros = $_POST['Otros'];

//Arma la instrucción SQL y luego la ejecuta
$vSql = "SELECT apellido_cliente, nombre_cliente FROM clientes WHERE nombre_cliente='$vNombre' and apellido_cliente='$vApellido'";

$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));

$vCantUsuarios = mysqli_fetch_assoc($vResultado);


//$vCantUsuarios = mysqli_result($vResultado, 0);
if ($vCantUsuarios !=0){
echo "<script>alert('[ERROR ]El cliente ya se registro anteriorimente');</script>";}
 else {
//Arma la instrucción SQL y luego la ejecuta
$vSql = "UPDATE clientes set nombre_cliente='$vNombre', apellido_cliente='$vApellido', dni='$vDni', email_cliente='$vEmail', cuentas_bancarias='$vCuentas', otros_datos='$vOtros' where id_cliente='$vID'";
mysqli_query($link,$vSql);

echo "<script>alert('El cliente fue Modificado');</script>";}
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
 


// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>