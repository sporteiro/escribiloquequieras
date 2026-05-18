<?php require_once('Connections/tema.php');

	if (!function_exists("GetSQLValueString")) {
			function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 	{
  				if (PHP_VERSION < 6) {
    			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  				}
		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
				switch ($theType) 	{
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
$editFormAction='';
require_once('recaptchalib.php');
$privatekey = "6Lf0_vASAAAAAGl6NfaNH0fZwwvxnqgGAmmxvEcN";


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fcomentario")) {

$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
     die (header('location: malcaptcha.html'));}
else{
     $currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 		 $insertSQL = sprintf("INSERT INTO Comentarios (nombre,comentario, ip, hora, CodPost) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['tunombre'], "text"),
                       GetSQLValueString($_POST['comentario'], "text"),
					   GetSQLValueString($_POST['otrocampo'], "text"),
					   GetSQLValueString($_POST['ocultosolora'], "text"),
                       GetSQLValueString($_POST['ocuide'], "int")
					   );

  mysql_select_db($database_tema, $tema);
  $Result1 = mysql_query($insertSQL, $tema) or die(mysql_error());

  $insertGoTo = "temas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}
			$colname_todo = "-1";
			if (isset($_GET['escribieron'])) {
  			$colname_todo = $_GET['escribieron'];
		}
	mysql_select_db($database_tema, $tema);
		$query_todo = sprintf("SELECT * FROM Post WHERE titulo = %s",
		GetSQLValueString($colname_todo, "text"));
		$todo = mysql_query($query_todo, $tema) or die(mysql_error());
		$row_todo = mysql_fetch_assoc($todo);
		$totalRows_todo = mysql_num_rows($todo);

$colname_DetailRS1 = "-1";
if (isset($row_todo['CodPost'])) {
  $colname_DetailRS1 = $row_todo['CodPost'];
}
mysql_select_db($database_tema, $tema);
$query_DetailRS1 = sprintf("SELECT * FROM Comentarios WHERE CodPost = %s ORDER BY CodCom DESC", GetSQLValueString($colname_DetailRS1, "int"));
$DetailRS1 = mysql_query($query_DetailRS1, $tema) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysql_num_rows($DetailRS1);

$colname_recormasvistos = "-1";
if (isset($_GET['escribieron'])) {
  $colname_recormasvistos = $_GET['escribieron'];
}
mysql_select_db($database_tema, $tema);
$query_recormasvistos =  sprintf("SELECT * FROM Post WHERE titulo = %s", GetSQLValueString($colname_recormasvistos, "int"));
$recormasvistos = mysql_query($query_recormasvistos, $tema) or die(mysql_error());
$row_recormasvistos = mysql_fetch_assoc($recormasvistos);
$totalRows_recormasvistos = mysql_num_rows($recormasvistos);

$maxRows_Recordlomasvisto = 5;
$pageNum_Recordlomasvisto = 0;
if (isset($_GET['pageNum_Recordlomasvisto'])) {
  $pageNum_Recordlomasvisto = $_GET['pageNum_Recordlomasvisto'];
}
$startRow_Recordlomasvisto = $pageNum_Recordlomasvisto * $maxRows_Recordlomasvisto;

mysql_select_db($database_tema, $tema);
$query_Recordlomasvisto = "SELECT * FROM Post WHERE titulo LIKE '%".substr( mysql_real_escape_string($row_todo['titulo']),0,3)."%' AND titulo!='".mysql_real_escape_string($row_todo['titulo'])."' ORDER BY visitas DESC";
$query_limit_Recordlomasvisto = sprintf("%s LIMIT %d, %d", $query_Recordlomasvisto, $startRow_Recordlomasvisto, $maxRows_Recordlomasvisto);
$Recordlomasvisto = mysql_query($query_limit_Recordlomasvisto, $tema) or die(mysql_error());
$row_Recordlomasvisto = mysql_fetch_assoc($Recordlomasvisto);

if (isset($_GET['totalRows_Recordlomasvisto'])) {
  $totalRows_Recordlomasvisto = $_GET['totalRows_Recordlomasvisto'];
} else {
  $all_Recordlomasvisto = mysql_query($query_Recordlomasvisto);
  $totalRows_Recordlomasvisto = mysql_num_rows($all_Recordlomasvisto);
}
$totalPages_Recordlomasvisto = ceil($totalRows_Recordlomasvisto/$maxRows_Recordlomasvisto)-1;

mysql_select_db($database_tema, $tema);
$query_Recordlomasvisto2 = "SELECT * FROM Post ORDER BY visitas DESC LIMIT 0 , 5";
$Recordlomasvisto2 = mysql_query($query_Recordlomasvisto2, $tema) or die(mysql_error());
$row_Recordlomasvisto2 = mysql_fetch_assoc($Recordlomasvisto2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="verify-v1" content="jLzDZBjVtNWtOfn2f2yKtMrlDZLI3BMhjT5OwjtINv4=" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="escribi lo que quieras sobre cualquier tema, escribi, lo, que, quieras" />
<meta name="keywords" content="<?php echo $row_todo['titulo']; ?>" />
<meta name="description" content="escribi lo que quieras" />
<title><?php echo $row_todo['titulo']; ?></title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script type="text/javascript">
var RecaptchaOptions = {
   theme : 'custom',
   tabindex : 3
};
</script>
</head>
<body onload="document.formvisitas.submit();"> 
	<?php
		function getIP() {
			if (isset($_SERVER)) {
				if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
				} 
				else {
				return $_SERVER['REMOTE_ADDR'];
				}
			} 
			else {
				if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
				return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
				} 
				else {
				return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
				}
			}
		}
?>
	<div id="amclaje"><a name="principio">.</a>
	</div>
	<div id="laquetiene">
		<div id="logo"><a href="index.php" target="_self"><img src="escribi.png" alt="escribi lo que quieras" width="250px" height="78px" class="titulares" /></a>
  		</div>
	</div>

<form id="fcomentario" name="fcomentario" method="post" action="<?php echo $editFormAction; ?>">
	<div id="cnugida">
 	    <div id="adinugui">
			<br />
			<div class="masletras" id="nombcribio"> <?php echo $row_todo['nombre']; ?> 
            		<span class="letritas">escribio:</span>
 			</div>
           	<br />
  		</div>
  		<br />
  		<div style="clear:both;"></div>
			<div id="asuntos">
				<div class="titulares"><?php echo $row_todo['titulo']; ?>
      			<input name="ocuide" type="hidden" id="ocuide" value="<?php echo $row_todo['CodPost']; ?>" />
  				</div>
          
    			<br />
  				<div id="asuntitos"><?php echo nl2br($row_todo['asunto']); ?>
      			<input name="ocultosolora" type="hidden" id="ocultosolora" value="el <?php echo date("d/m/Y");?> a las <?php echo date("H:i");?> " />
			<br />
			<br />
			<hr />
			<p class="letritas">
			<span style="float:left;">Fecha de publicaci&oacute;n <?php echo $row_todo['hora']; ?></span>
			<span style="float:right;"><a href="contacto.php?denunciar=<?php echo $row_todo['titulo']; ?>">Denunciar</a></span>
			</p>
		<div style="clear:both;"></div>
  		</div>
    <span class="titulares">
    	<br />
    </span>
    <div class="titulares"><?php if ($totalRows_DetailRS1<"1") { // Si no hay comentarios ?>
                    NO HAY <?php } // Mostra esto otro ?>
                       COMENTARIOS:</div>
    <br />
      <?php
	
	$numCom=$totalRows_DetailRS1+1;
	 do { ?>
    <div id="<?=$row_DetailRS1['CodCom']?>" class="repetir">
      <div id="elnombrecom"><?php if ($row_DetailRS1['nombre']!="") { ?><span class="numCom">#<?=$numCom-1?></span><?}?> <?php echo $row_DetailRS1['nombre']; ?>
	<span class="letritas"> <?php if ($row_DetailRS1['nombre']!="") { // Si esta esto ?>
                              dijo: <?php } // Mostralo  ?></span></div> 
      <div class="letritas" id="lahora"><?php if ($row_DetailRS1['nombre']!="") { // Si esta esto ?>
        <?php echo $row_DetailRS1['hora']; ?> <?php } // Mostralo  ?></div>
        <br />
      <div id="<?=$numCom-1?>" class="coment"><?php echo nl2br($row_DetailRS1['comentario']); ?><?php if ($row_DetailRS1['comentario']=="") { // Si no esta esto ?>
                      <a href="#principio">Volv&eacute; al principio</a>        <?php } // Mostra esto otro ?></div>
      <br />
    </div>
    <?$numCom=$numCom-1;?>
    <?php } while ($row_DetailRS1 = mysql_fetch_assoc($DetailRS1)); 
	$numCom=$numCom-1;
	?>
    
    <br />
    <div id="penultima"> <span id="sprytextfield1">
        <label><span class="titulares">
        <br />
        <br />
        <br />
       Tu Nombre
       <br />
        </span>
        <input name="tunombre" type="text" class="imputis" id="tunombre" tabindex="1" size="40" maxlength="40" />
        </label>   <br /><span class="textfieldRequiredMsg">Todos los campos son obligatorios</span><span class="textfieldMinCharsMsg">Muy pocos caracteres</span><span class="textfieldMaxCharsMsg"> Demasiados caracteres</span></span>
        <p><span id="sprytextarea1">
          <label><span class="titulares">Comentario
          <br />
          </span>
          <textarea name="comentario" cols="45" rows="5" class="imputis" id="comentario" tabindex="2"></textarea><br />
          <span class="letritas">Te quedan </span> <span id="countsprytextarea1" class="letritas">&nbsp;</span></label> </span><span class="letritas"> caracteres por escribir.</span>
          <input name="otrocampo" type="hidden" id="otrocampo" value="<?php echo getIP(); ?>" />
        </p>
        <div><span class="titulares">Escribi estas palabras</span><br />
      <div  class="imputis" id="recaptcha_image" style="width:300px; height:57px; margin: 0 auto;"></div>
        <p class="letritas"><a href="javascript:Recaptcha.reload()">Cambiar palabras</a></p>
        <span id="sprytextfield2"><label>
      <input  class="imputis" tabindex="3" id="recaptcha_response_field" name="recaptcha_response_field" /></label></span>
      <? require_once('recaptchalib.php');
$publickey = "6Lf0_vASAAAAABfxgtP5VdNqqSXKfElZTcQDJN_q";
echo recaptcha_get_html($publickey);
?>
      </div>
        <p>
          <label>
          <input name="listo" type="submit" class="botones" id="listo" tabindex="4" value="Publicá tu comentario" />
          </label>
        </p>
          <p>
            <input type="hidden" name="MM_insert" value="fcomentario" />
        
          </p>
          <p><a href="#principio"><img src="flecha3.png" title="subir al principio de la pagina" width="20px" height="40px" alt="ir al principio" class="titulares"/></a></p>
    </div>
          </div>
             <div class="postitparatemas">
           <span class="titulares">Pueden interesarte estos posts</span><br />
           <hr />
<?php 
if ($totalRows_Recordlomasvisto>0)	{
do { ?>
<div class="cadaPostit">
  <span class="letrasnormales">
    <a href="temas.php?escribieron=<?php echo $row_Recordlomasvisto['titulo']; ?>"><?php echo $row_Recordlomasvisto['titulo']; ?></a></span> <span class="masletras"><img src="<?php echo $row_Recordlomasvisto['categoria']; ?>.png" width="25px" height="25px" alt="<?php echo $row_Recordlomasvisto['categoria']; ?>" title="Este post contiene <?php echo $row_Recordlomasvisto['categoria']; ?>"/></span>
  <br />
</div>
  <?php } while ($row_Recordlomasvisto = mysql_fetch_assoc($Recordlomasvisto)); 
} 
else {
	do { ?>
<div class="cadaPostit">
  <span class="letrasnormales">
    <a href="temas.php?escribieron=<?php echo $row_Recordlomasvisto2['titulo']; ?>"><?php echo $row_Recordlomasvisto2['titulo']; ?></a></span> <span class="masletras"><img src="<?php echo $row_Recordlomasvisto2['categoria']; ?>.png" width="25px" height="25px" alt="<?php echo $row_Recordlomasvisto2['categoria']; ?>" title="Este post contiene <?php echo $row_Recordlomasvisto2['categoria']; ?>"/></span>
  <br />
</div>
  <?php } while ($row_Recordlomasvisto2 = mysql_fetch_assoc($Recordlomasvisto2)); 


}
?>
<br />
  </div><br /></div>
              </form>
  <br />
<br />
<div style="clear:both;"></div>
<div id="ultimo">
TODOS LOS DERECHOS RESERVADOS. Escribiloquequieras no es responsable del contenido.<br />
DISE&Ntilde;O Y DESARROLLO DEL SITIO: <a href="http://www.sebastianporteiro.com.ar" target="_blank">SEBASTIAN PORTEIRO</a>.
	<br />
	Sitio alojado en <a href="http://www.000webhost.com/147501.html" target="_blank">000webhost</a>
	 <p>
		 <a href="http://jigsaw.w3.org/css-validator/check/referer">
    		<img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="¡CSS Válido!" class="titulares" style="border:0;width:57px;height:20px" />
		</a>
		<a href="http://www.sebastianporteiro.com.ar" target="_blank"><img src="sebastianporteiro.gif" alt="Sebastian Porteiro" width="25px" height="25px" class="titulares" /></a>
	</p>
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
		} 
	catch(err) {}
</script>
<script type="text/javascript">
	var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:3, maxChars:30});
	var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
	var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {counterType:"chars_remaining", counterId:"countsprytextarea1", minChars:5, maxChars:2000});
</script>
<?php
			$copos=$row_todo['CodPost'];
  			$updateSQL = "UPDATE Post SET visitas=visitas+1 WHERE CodPost = ".$copos." ";
			mysql_select_db($database_tema, $tema);
  			$Result1 = mysql_query($updateSQL, $tema) or die(mysql_error());
?>
<script type="text/javascript">
   var infolink_pid = 87186;
   var infolink_wsid = 0;
</script>
<script type="text/javascript" src="http://resources.infolinks.com/js/infolinks_main.js"></script>

</body>
</html>
<?php
mysql_free_result($todo);
mysql_free_result($DetailRS1);
mysql_free_result($recormasvistos);
?>
