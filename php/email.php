<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>


<?php
include("conexion.inc");

$vSql = "select saldo_efectivo, saldo_cheques, saldo_otros, saldo_ec from cajas where id_caja=1";
$Re = mysqli_query($link, $vSql);
$R = mysqli_fetch_array($Re);

	 
 $EFECTIVO=$R['saldo_efectivo'];
$CHEQUES=$R['saldo_cheques'];
$EFECTIVO_CHEQUE=$R['saldo_ec'];
           
               
     
	$mensaje_mail = "SALDOS ACTUALES DE LA CAJA:\n\n";
	$mensaje_mail = "Saldo efectivo:\r\n";
	$mensaje_mail= $EFECTIVO;
	$mensaje_mail = "Saldo cheque:\r\n";
	$mensaje_mail = $CHEQUES;
	$mensaje_mail = "Saldo cheque y efectivo:\r\n";
	$mensaje_mail = $EFECTIVO_CHEQUE;
	$mensaje_mail =  "Para revisar la caja de hoy presione www.oficinacañada.com :\r\n";
	$mail = "Reporte de caja_hoy Oficina Cañada";
	//Titulo
	$asunto = "Reporte de caja_hoy Oficina Cañada";
	//cabecera
	$headers = "MIME-Version: 1.0\r\n";
	$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
	//dirección del remitente
	
	//Enviamos el mensaje a tu_dirección_email
	$bool = mail('giselmanuale@gmail.com',$asunto,$mensaje_mail,$headers);
	if($bool){
		echo "Mensaje enviado";
	}else{
		echo "Mensaje no enviado";
	}

?>

<body>
</body>
</html>
