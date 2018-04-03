<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


} else {

   echo "No autorizado, necesito loguearse.<br>";

   echo "<br><a href='login.html'>Login</a>";
   
exit;
}
$now = time();
if($now > $_SESSION['expire']) {

session_destroy();
echo "Su sesion a terminado,
<a href='../login.html'>Necesita loguearse</a>";
exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Panel de Control</title>
</head>
<body>
<ul>
  <li>Editar Configuracion</li>

</ul>
<a href=logout.php>Cerrar Sesion X </a>
</body
</html>


if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
} esto valida si se cerro la sesion no t deja entrar
