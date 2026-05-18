<?php require_once('Connections/tema.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_busqueda = "-1";
if (isset($_POST['buscar'])) {
  $colname_busqueda = $_POST['buscar'];
}
mysql_select_db($database_tema, $tema);
$query_busqueda = sprintf("SELECT * FROM Post WHERE titulo LIKE %s ORDER BY visitas DESC, hora DESC, titulo DESC", GetSQLValueString("%" . $colname_busqueda . "%", "text"));
$busqueda = mysql_query($query_busqueda, $tema) or die(mysql_error());
$row_busqueda = mysql_fetch_assoc($busqueda);
$totalRows_busqueda = mysql_num_rows($busqueda);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="verify-v1" content="jLzDZBjVtNWtOfn2f2yKtMrlDZLI3BMhjT5OwjtINv4=" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="escribi lo que quieras sobre cualquier tema, escribi, lo, que, quieras" />
<meta name="description" content="escribi lo que quieras" />
<title>Escribi lo que quieras</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>


<div id="laquetiene">
              <div id="logo"><a href="index.php" target="_self"><img src="escribi.png" alt="escribi lo que quieras" class="titulares" /></a>
  </div>
</div>

<div id="cnugida">
     <div id="adinugui"></div>
  <div id="glugle"></div>
  <div id="busquedaresulta">
    <div class="titulares">RESULTADOS DE TU BUSQUEDA:</div>
	<br />
    <?php if ($totalRows_busqueda == 0) { ?>
          <a href="index.php" target="_self" class="masletras">No encontraste lo que buscabas</a>
    <?php } ?>
    <?php if ($totalRows_busqueda > 0)  do { ?>
      <div id="resultados">
	<div class="adentropostit">
		<div class="cadaPostit">
 			<span class="letrasnormales">   		
				<a href="temas.php?escribieron=<?php echo $row_busqueda['titulo']; ?>"><?php echo $row_busqueda['titulo']; ?></a>
			</span>
        		<span class="masletras"><img src="<?php echo $row_busqueda['categoria']; ?>.png" width="20px" height="20px" alt="<?php echo $row_busqueda['categoria']; ?>" title="Este post contiene <?php echo $row_busqueda['categoria']; ?>"/>
			</span>
			<p class="letripostit">
			<?php
			if ($row_busqueda['categoria']=='texto')	{
				echo '<a href="temas.php?escribieron='.$row_busqueda['titulo'].'">'.substr($row_busqueda['asunto'],0,300).'...</a>'; 
			}
			else if ($row_busqueda['categoria']=='imagenes')	{
				echo '<p class="minimagen">'.substr($row_busqueda['asunto'],0,3000).'...</p>'; 
			}
			?>
			</p>
  			<br />
			</div>
	</div>
	
      </div>
      <br />
      <?php }  while ($row_busqueda = mysql_fetch_assoc($busqueda)); ?>  
      <div id="nohay">

</div>
<div id="parabanner"></div>
  </div>
<br />
</div>
<br />
<div style="clear:both;"></div>
<div id="ultimo">
TODOS LOS DERECHOS RESERVADOS. Escribiloquequieras no es responsable del contenido.<br />
DISE&Ntilde;O Y DESARROLLO DEL SITIO: <a href="http://www.sebastianporteiro.com.ar" target="_blank">SEBASTIAN PORTEIRO</a>.<br />
Sitio alojado en <a href="http://www.000webhost.com/147501.html" target="_blank">000webhost</a>
 <p>
 <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="¡CSS Válido!" class="titulares" style="border:0;width:57px;height:20px" />
</a>

  <a href="http://www.sebastianporteiro.com.ar" target="_blank"><img src="sebastianporteiro.gif" alt="Sebastian Porteiro" width="25px" height="25px" class="titulares" /></a></p>
<br />
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9285822-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
<?php
mysql_free_result($busqueda);
?>
