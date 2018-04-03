<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head> <body>
<?php
session_start();
include("conexion.inc");
//Captura datos desde el Form anterior

$vFecha = $_POST['Fecha'];
$vMonto = $_POST['Monto'];
$vForma = $_POST['Forma'];
$vMotivo = $_POST['Motivo'];
$vObs = $_POST['Obs'];
$vCuenta =$_POST['Cuenta'];

settype($vCuenta,"integer");
if($vObs=='Opcional'){$vObs='';}


$vSql = "INSERT INTO movimientos_caja (fecha, tipo, monto, forma_movimiento, motivo, observacion, id_caja, id_cuenta)
values ('$vFecha', 'egreso','$vMonto','$vForma','$vMotivo', '$vObs', 1, '$vCuenta')";

 mysqli_query($link, $vSql) or die (mysqli_error($link));
 $vSql = "select saldo_efectivo, saldo_cheques, saldo_otros, saldo_ec from cajas where id_caja=1";
$Re = mysqli_query($link, $vSql);
$R = mysqli_fetch_array($Re);
 
       if(  ($vForma=='Efectivo'))
                    { ($R['saldo_efectivo']=$R['saldo_efectivo']-$vMonto); }
                   else {if( ($vForma=='Cheque')){ ($R['saldo_cheques']=$R['saldo_cheques']-$vMonto); } 
                         else { $R['saldo_otros']=$R['saldo_otros']-$vMonto;
					 }}  $R['saldo_ec']=$R['saldo_efectivo']+$R['saldo_cheques'];
					 
	$vSql = "UPDATE cajas c inner join movimientos_caja m on c.id_caja=m.id_caja set c.saldo_cheques=".$R['saldo_cheques'].", 
c.saldo_efectivo=".$R['saldo_efectivo'].", c.saldo_otros=".$R['saldo_otros'].", c.saldo_ec=".$R['saldo_ec']." where c.id_caja=1";
  mysqli_query($link, $vSql); 				 
					 
 echo "<script>alert('El egreso se registró con éxito');</script>";

 if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="altaegreso.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Ualtaegreso.php";
</script>
<?php }


mysqli_close($link);
?>


</body>
</html>