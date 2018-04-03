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
$vNum = $_POST['NumeroCuota'];
$vid = $_POST['id'];
$vfechav = $_POST['fechav'];
if($vObs=='Opcional'){$vObs='';}

$vSql = "SELECT * FROM servicios  WHERE  id_prestacion='$vid'";
$RR=mysqli_query($link, $vSql) or die (mysqli_error($link));
$vCantID = mysqli_fetch_assoc($RR);
if($vCantID!=0){

$vSql = "SELECT m.idcuotas_clientes FROM movimientos_caja m inner join cuotas_clientes c 
on m.idcuotas_clientes=c.idcuotas_clientes 
WHERE c.nro_cuota='$vNum' and c.id_prestacion='$vid' and c.fecha_vencimiento='$vfechav'";

$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));

$vCantUsuarios = mysqli_fetch_assoc($vResultado);

$vSql = "SELECT idcuotas_clientes from cuotas_clientes c 

WHERE c.nro_cuota='$vNum' and c.id_prestacion='$vid' and c.fecha_vencimiento='$vfechav'";

$vR = mysqli_query($link, $vSql) or die (mysqli_error($link));

$vC = mysqli_fetch_assoc($vR);


//echo($vCantUsuarios['idcuotas_clientes']);

//$vCantUsuarios = mysqli_result($vResultado, 0);
if ($vCantUsuarios !=0){
	 echo "<script>alert('La cuota ya fue pagada anteriormente');</script>";}
 else {
	 
	 
$vSql = "INSERT INTO movimientos_caja (fecha, tipo, monto, forma_movimiento, motivo, observacion, id_caja, idcuotas_clientes, id_prestacion, fecha_vencimiento)
values ('$vFecha', 'ingreso','$vMonto','$vForma','$vMotivo', '$vObs', 1 ,".$vC['idcuotas_clientes'].", '$vid', '$vfechav')";
 mysqli_query($link, $vSql) or die (mysqli_error($link));
 
 
 
 
 $vSql = "UPDATE cuotas_clientes c inner join movimientos_caja m on c.idcuotas_clientes=m.idcuotas_clientes set c.estado='Paga' where and c.importe=m.monto";
  mysqli_query($link, $vSql);
 
  
$vSql = "select saldo_efectivo, saldo_cheques, saldo_otros, saldo_ec from cajas where id_caja=1";
$Re = mysqli_query($link, $vSql);
$R = mysqli_fetch_array($Re);

         if(  ($vForma=='Efectivo'))
                    { ($R['saldo_efectivo']=$R['saldo_efectivo']+$vMonto); }
                   else {if( ($vForma=='Cheque')){ ($R['saldo_cheques']=$R['saldo_cheques']+$vMonto); } 
                         else { $R['saldo_otros']=$R['saldo_otros']+$vMonto;
					 }} 
 $R['saldo_ec']=$R['saldo_efectivo']+$R['saldo_cheques'];
					 
          
 $vSql = "UPDATE cajas c inner join movimientos_caja m on c.id_caja=m.id_caja set c.saldo_cheques=".$R['saldo_cheques'].", 
c.saldo_efectivo=".$R['saldo_efectivo'].", c.saldo_otros=".$R['saldo_otros'].", c.saldo_ec=".$R['saldo_ec']." where c.id_caja=1";
  mysqli_query($link, $vSql);  

 echo "<script>alert('El ingreso se registró con éxito');</script>"; }} else {
	 echo "<script>alert('El Id Prestacion no fue cargado en REGISTRAR SERVICIO o dato incorrecto!!');</script>";
	 }
 
 
if ($_SESSION['tipo_usuario'] == "Administrador"){ 
?>
<script>
location.href="altaingreso.php";
</script>
<?php }
else if ($_SESSION['tipo_usuario'] == "Usuario")
{ ?>
<script>
location.href="Ualtaingreso.php";
</script>
<?php }
 

 //header('Location: ../registrarcuenta.html');
 
// Liberar conjunto de resultados
mysqli_free_result($vResultado);


mysqli_close($link);
?>


</body>
</html>