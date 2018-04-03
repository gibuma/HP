<html>
<head>
<title></title>
</head>
<body>
<?php
include ("conexion.inc");
$vDNI = $_POST ['DNI'];
$vSql = "SELECT * FROM servicios WHERE dni='$vDNI' ";
$vResultado = mysqli_query($link, $vSql);
if(mysqli_num_rows($vResultado) == 0)
 {
 echo ("Servicio Inexistente...!!! <br>");
 
}
else{
//Arma la instrucción SQL y luego la ejecuta
$vSql= "DELETE FROM servicios WHERE dni = '$vDNI' ";
mysqli_query($link, $vSql);
 echo("El Servicio fue Borrado<br>");

}
// Liberar conjunto de resultados
mysqli_free_result($vResultado);
// Cerrar la conexion
mysqli_close($link);
?>
</body>
</html>