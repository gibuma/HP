<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


} else {

   echo "No autorizado, necesita loguearse.<br>";

   echo "<br><a href='../login.html'>Login</a>";
   
exit();
}

$now = time();
if($now > $_SESSION['expire']) {

session_destroy();
echo "Su sesion a terminado,
<a href='../login.html'>Necesita loguearse</a>";
exit();
}

if ($_SESSION['tipo_usuario'] == "Administrador") {


} else {

   echo "No autorizado para ésta sección!!!<br>";

   echo "<br><a href='../login.html'>Login</a>";
   
exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>



<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-<scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<title>Gestión de Oficina - Cañada Rica</title>

<!-- Bootstrap -->
<link href="../css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
function validacion() {
if (document.getElementById("NumeroCuota").value == null || document.getElementById("NumeroCuota").value == 0 || /^\s+$/.test(document.getElementById("NumeroCuota").value)) {
    
    alert('[ERROR] Numero Cuota no puede estar vacío');
    return false;
  }
   else if(document.getElementById("Fecha").value == "aaaa-mm-dd" || !isNaN(document.getElementById("Fecha").value))
    {	     
    alert('[ERROR] Fecha invalida'); 
    return false;}
	
  
  else if (document.getElementById("id").value == null || document.getElementById("id").value == 0 || /^\s+$/.test(document.getElementById("id").value)) {
    
    alert('[ERROR] Id no puede estar vacío');
    return false;
  }
    else if (document.getElementById("Motivo").value == null || document.getElementById("Motivo").value == 0 || /^\s+$/.test(document.getElementById("Motivo").value)) {
    
    alert('[ERROR] Motivo no puede estar vacío');
    return false;
  }
  else if( (document.getElementById("Forma").selectedIndex) == null || (document.getElementById("Forma").selectedIndex) == 0 )
    {
	  
   
    alert('[ERROR] Debe seleccionar una forma'); 
    return false;}

	

	 else if(document.getElementById("fechaV").value == "aaaa-mm-dd" || !isNaN(document.getElementById("fechav").value))
    {	     
    alert('[ERROR] Fecha invalida'); 
    return false;}
 
  
  
 
  
  return true;
  }
</script>
</head>
<body width="100%" background="../ima/fondo.jpg">

<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">Sistema de Gestión</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <!-- este es el menu principal-->
     
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container-fluid">
  <div class="row">
  <center>
    <form id="form1" name="form1" method="post" action="modificaringresoBD.php" onSubmit="return validacion()">
      <?php
include("conexion.inc");

$vf= $_POST['fi'];

$vSql = "SELECT c.nro_cuota,  m.fecha, m.monto, m.fecha_vencimiento, m.id_movimientocaja, m.id_prestacion, m.forma_movimiento,
 m.motivo, m.observacion FROM movimientos_caja m inner join cuotas_clientes c on m.idcuotas_clientes=c.idcuotas_clientes  
where $vf=m.id_movimientocaja";

$vResu = mysqli_query($link, $vSql);
$vResultado = mysqli_fetch_array($vResu);

?>
      <p><h3>Ingresos Caja</h3></p>
      <p>&nbsp;</p>
      <p>
        <label for="textfield">Fecha:</label>
        <input name="Fecha" type="text" id="Fecha"  value="<?php echo($vResultado['fecha']); ?>">
        </select>
        
       
       
     
        
      </p>
      <p><br>
        
        <label for="textfield8">Motivo:</label>
        <input type="text" name="Motivo" id="Motivo" value="<?php echo ($vResultado['motivo']); ?>" >
        <label for="textfield9">Observación:</label>
        <input name="Obs" type="text" id="Obs" value="<?php echo ($vResultado['observacion']); ?>" >
        <input  name="id_m" type="hidden" id="id_m" value="<?php echo ($vResultado['id_movimientocaja']); ?>" >
  </p>
      <p>&nbsp;</p>
      <p>
        <input type="submit" href="modificaringresoBD.php" name="button" id="button" value="Registrar">
        
        <a href="../inicioAdministrador.php">   <input type="button"  name="Salir" id="Salir" value="Salir"></A>
      </p>
    </form>
    <p>&nbsp;</p>
  </center>
    <div class="col-md-offset-2 col-md-8">
     
    </div>
  </div>
  <hr>
</div>
<?php // Liberar conjunto de resultados
mysqli_free_result($vResu);


// Cerrar la conexion
mysqli_close($link);
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
