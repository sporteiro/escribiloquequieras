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

  require_once('recaptchalib.php');
$privatekey = "6LcHegkAAAAAAKZsDfVJlKaiKHy8WnJMk1SXfhzz ";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
      $error_captcha = $resp->error; }
else{
     $currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fpostear")) {
  $insertSQL = sprintf("INSERT INTO Post (nombre, titulo, asunto, hora, ip, categoria, visitas) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['asunto'], "text"),
                       GetSQLValueString($_POST['ocultosolora'], "text"),
                       GetSQLValueString($_POST['otrocampo'], "text"),
					   GetSQLValueString($_POST['catagoria'], "text"),
                       GetSQLValueString($_POST['vistoid'], "int"));

  mysql_select_db($database_tema, $tema);
  $Result1 = mysql_query($insertSQL, $tema) or die(mysql_error());
  
 
   }
}
$maxRows_todo = 10;
$pageNum_todo = 0;
if (isset($_GET['pageNum_todo'])) {
  $pageNum_todo = $_GET['pageNum_todo'];
}
$startRow_todo = $pageNum_todo * $maxRows_todo;

mysql_select_db($database_tema, $tema);
$query_todo = "SELECT * FROM Post WHERE categoria='texto'  ORDER BY CodPost DESC";
$query_limit_todo = sprintf("%s LIMIT %d, %d", $query_todo, $startRow_todo, $maxRows_todo);
$todo = mysql_query($query_limit_todo, $tema) or die(mysql_error());
$row_todo = mysql_fetch_assoc($todo);

if (isset($_GET['totalRows_todo'])) {
  $totalRows_todo = $_GET['totalRows_todo'];
} else {
  $all_todo = mysql_query($query_todo);
  $totalRows_todo = mysql_num_rows($all_todo);
}
$totalPages_todo = ceil($totalRows_todo/$maxRows_todo)-1;

$maxRows_Recordlomasvisto = 5;
$pageNum_Recordlomasvisto = 0;
if (isset($_GET['pageNum_Recordlomasvisto'])) {
  $pageNum_Recordlomasvisto = $_GET['pageNum_Recordlomasvisto'];
}
$startRow_Recordlomasvisto = $pageNum_Recordlomasvisto * $maxRows_Recordlomasvisto;

mysql_select_db($database_tema, $tema);
$query_Recordlomasvisto = "SELECT * FROM Post  WHERE categoria='texto' ORDER BY visitas DESC";
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
$query_Recordinsertarvisto = "SELECT * FROM Post ORDER BY CodPost DESC";
$Recordinsertarvisto = mysql_query($query_Recordinsertarvisto, $tema) or die(mysql_error());
$row_Recordinsertarvisto = mysql_fetch_assoc($Recordinsertarvisto);
$totalRows_Recordinsertarvisto = mysql_num_rows($Recordinsertarvisto);

$queryString_todo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_todo") == false && 
        stristr($param, "totalRows_todo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_todo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_todo = sprintf("totalRows_todo=%d%s", $totalRows_todo, $queryString_todo);
?>
 <?php $ip = $_SERVER['REMOTE_ADDR'];?> 
    <? $ips_baneadas = array('93.81.148.182');   
    $contador = count($ips_baneadas);   
    for ($i=0; $i<$contador; $i++) {   
    if($ip == $ips_baneadas[$i]) { die("ACCESO DENEGADO . $ip"); } } ?>  
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Keywords" content="escribi lo que quieras sobre cualquier tema, escribi, lo, que, quieras" />
<meta name="Description" content="escribi lo que quieras" />
<meta name="verify-v1" content="jLzDZBjVtNWtOfn2f2yKtMrlDZLI3BMhjT5OwjtINv4=" />
<title>Escribi lo que quieras</title>

<link href="estilo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<script type="text/javascript">
var RecaptchaOptions = {
   theme : 'custom',
   tabindex : 5
};
</script>

</head>
<body>
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
<!-- INICIO PARTE DE ARRIBA LOGO Y CONTENEDORA-->

<div id="laquetiene">
	<div id="logo"><a href="index.php" target="_self"><img src="escribi.png" alt="escribi lo que quieras" width="300px" height="94px" class="titulares" /></a>
    <div style="float: right; margin-top:2%;">
   <iframe src="http://rcm-es.amazon.es/e/cm?t=e0cd-21&o=30&p=13&l=ur1&category=informatica&banner=11QR1B745JBP9HQ1VRR2&f=ifr" width="468" height="60" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
    </div>
	</div>
</div>
<!-- FIN PARTE DE ARRIBA LOGO -->

<!-- INICIO PARTE DERECHA-->
<div id="cnugida" >
	<div id="adinugui" >
		<div id="conti"> 
			<form id="busqueda" name="busqueda" method="post" action="busca.php">
       		<span id="sprytextfield4"> 
      			<label>
      				<input name="buscar" type="text" class="imputis" id="buscar" tabindex="1" value="Búsqueda por titulo" onblur="if(this.value=='') this.value='Búsqueda por titulo';" onfocus="if(this.value=='Búsqueda por titulo') this.value='';"  size="30" maxlength="30" />
     			</label>
			</span>
            	<label>
            		<input name="buscar1" type="submit" class="botones" id="buscar1" tabindex="2" onclick="MM_validateForm('buscar','','R');return document.MM_returnValue" value="Buscar" />
      			</label>
			</form>
		</div>
	</div>
    <div style="clear:both;"></div>
  	<br />
  	<div id="postit">
    	<div class="adentropostit">
    	<span class="titulares">Post Recientes</span>
    <hr />
    	<?php do { ?>
      		<div>
            	<a href="temas.php?escribieron=<?php echo $row_todo['titulo']; ?>" class="masletras"><?php echo $row_todo['titulo']; ?></a>  
                <span class="masletras"><img src="<?php echo $row_todo['categoria']; ?>.gif" width="25px" height="25px" alt="<?php echo $row_todo['categoria']; ?>" title="Este post contiene <?php echo $row_todo['categoria']; ?>"/>
                </span>
			</div>
		<?php } while ($row_todo = mysql_fetch_assoc($todo)); ?>
        	<br /><hr />
			<div id="flechas">
            	<a href="<?php printf("%s?pageNum_todo=%d%s", $currentPage, 0, $queryString_todo); ?>">Nuevos 
                </a>
                <a href="<?php printf("%s?pageNum_todo=%d%s", $currentPage, max(0, $pageNum_todo - 1), $queryString_todo); ?>"><img src="flecha.png" alt="atras" width="40" height="20" class="titulares" />
                </a>
                <a href="<?php printf("%s?pageNum_todo=%d%s", $currentPage, min($totalPages_todo, $pageNum_todo + 1), $queryString_todo); ?>">     <img src="flecha2.png" alt="adelante" width="40" height="20" class="titulares" />  
                </a>
                <a href="<?php printf("%s?pageNum_todo=%d%s", $currentPage, $totalPages_todo, $queryString_todo); ?>">Antiguos</a>
			</div><br />
            </div>
            <br />
            <div class="adentropostit">
 			<span class="titulares">Lo mas visto ultimamente</span><hr />
				<?php do { ?>
  				<span class="letrasnormales">
    				<a href="temas.php?escribieron=<?php echo $row_Recordlomasvisto['titulo']; ?>"><?php echo $row_Recordlomasvisto['titulo']; ?>
                    </a>
                </span>
               <span class="masletras"><img src="<?php echo $row_Recordlomasvisto['categoria']; ?>.gif" width="25px" height="25px" alt="<?php echo $row_Recordlomasvisto['categoria']; ?>" title="Este post contiene <?php echo $row_Recordlomasvisto['categoria']; ?>"/></span>
  <br />
  <?php } while ($row_Recordlomasvisto = mysql_fetch_assoc($Recordlomasvisto)); ?>
  <br />
  </div>
  <br />
  <div class="adentropostit">
  <span class="titulares">Elegir contenido:</span><hr />
  <p class="titulares"><a href="indexvideos.php"> <img src="videos.gif" width="25px" height="25px" alt="Videos" title="Ver posts que contienen videos"/>Videos</a>  <a href="indeximagenes.php"> <img src="imagen.gif" width="25px" height="25px" alt="Imagenes" title="Ver posts que contienen imagenes"/> Imágenes</a> <a href="indextexto.php"> <img src="texto.gif" width="25px" height="25px" alt="Texto" title="Ver posts que contienen texto"/> Sólo texto</a></p>
  </div>
  </div>
<!-- FIN PARTE DERECHA-->
      
      
<!-- INICIO PARTE IZQUIERDA-->      
<div class="titulares" id="forpost">&iexcl;&iexcl;Bienvenido, escrib&iacute; lo que quieras sin registrarte!!<br />
<br />
  <form id="fpostear" name="fpostear" method="post" action="<?php echo $editFormAction; ?>">
<span id="sprytextfield1">   
    <label>NOMBRE 
      <span class="letritas">(El nombre que quieras)</span><br />
      <input name="nombre" type="text" class="imputis" id="nombre" tabindex="3" size="40" maxlength="50" />
      </label>
      <input name="ocultosolora" type="hidden" id="ocultosolora" value="el <?php echo date("d/m/Y");?> a las <?php echo date("H:i");?> " />
      <br />
      <span class="textfieldRequiredMsg">Todos los campos son obligatorios</span><span class="textfieldMinCharsMsg">Muy pocos caracteres</span><span class="textfieldMaxCharsMsg"> Demasiados caracteres</span></span>
    
      <p>
      <span id="sprytextfield2">  
      <label>TITULO
<span class="letritas">(El titulo que va a tener tu post)</span><br />
        <input name="titulo" type="text" class="imputis" id="titulo" tabindex="4" size="40" maxlength="50" />
        </label><br />
          <span class="textfieldRequiredMsg">Todos los campos son obligatorios</span><span class="textfieldMinCharsMsg">Muy pocos caracteres</span><span class="textfieldMaxCharsMsg"> Demasiados caracteres</span></span>
      </p>
      <div><span class="titulares">Escribi estas palabras</span>
      <span class="letritas">(Esto es para evitar spam)</span><br />
      <div class="imputis" id="recaptcha_image" style="width:300px; height:57px;"></div>
        <span class="letritas"><a href="javascript:Recaptcha.reload()">Cambiar palabras</a></span><br />
         <span id="sprytextfield3">  
        <label>
      <input  class="imputis" tabindex="3" id="recaptcha_response_field" name="recaptcha_response_field" /></label></span>
      <? require_once('recaptchalib.php');
$publickey = "6LcHegkAAAAAACql12qZ0tl_V2tQywVPiPwWgKXT";
echo recaptcha_get_html($publickey);
?>
      </div>
        
    <p><span id="sprytextarea1">
      <label>CONTENIDO
		<span class="letritas">(El contenido de tu post. Podes enlazar imagenes o videos)<br /><br />
			<a href="javascript:especiales('url')"><img src="imagen.gif" width="25" height="25" alt="Insertar imagen" title="Insertar imagen" />Enlazar imágenes
            </a> 
 			<a href="javascript:especiales('enlaces')"><img src="enlaces.gif" width="25" height="25" alt="insertar enlaces" title="Insertar enlace" />Crear un enlace
            </a>
		</span>
		 
  <br />
 		<textarea name="asunto" cols="45" rows="7" class="imputis" id="asunto" tabindex="6" onkeydown="textCounter(this.form.asunto,this.form.remLen,2000);" onkeyup="javascript:storeCaret(this); textCounter(this.form.asunto,this.form.remLen,2000);" onchange="javascript:storeCaret(this);" onclick="javascript:storeCaret(this);">
        </textarea>
<br />
         <span class="letritas">Te quedan </span> <span id="countsprytextarea1" class="letritas">&nbsp;</span></label> </span><span class="letritas">caracteres por escribir.</span>
      <input name="otrocampo" type="hidden" id="otrocampo" value="<?php echo getIP(); ?> " />
      </p>
      <span class="letritas">&iquest;Podrias decir que vas a publicar?</span>
      <select name="catagoria" class="imputis" id="catagoria" tabindex="7" >
        <option value='videos'>VIDEOS</option>
        <option value='imagenes'>IMAGENES</option>
        <option value='texto' selected="selected">SOLO TEXTO</option>
      </select>
      <input name="vistoid" id="vistoid" type="hidden" value="<?php echo $row_Recordinsertarvisto['CodPost']; ?>"/>
      <p>
      <label>
      <br />
        <input name="listo" type="submit" class="botones" id="listo" tabindex="8" value="Publicá tu post" />
        </label>
      </p>
    
    <p>&nbsp;</p> <p>&nbsp;</p>
    <input type="hidden" name="MM_insert" value="fpostear" />
  </form>
    <p>&nbsp;</p>
   <div style="clear:both;"></div>
</div>

</div>
<!-- FIN PARTE IZQUIERDA-->
<div style="clear:both;"></div>

<br />

<!-- INICIO ULTIMO -->

<div id="ultimo">
<div class="letrasnormales">
        	<a href="terminos.php">Términos y condiciones generales de uso</a> | <a href="http://www.escribiloquequieras.com.ar/temas.php?escribieron=%BFque%20es%20Escribiloquequieras?">&iquest;Qu&eacute; es es escribiloquequieras? </a> | <a href="contacto.php">Contactar con el equipo de desarrollo</a>
		</div>
        <br />
TODOS LOS DERECHOS RESERVADOS. Escribiloquequieras no es responsable del contenido.<br />
DISE&Ntilde;O Y DESARROLLO DEL SITIO: <a href="http://www.sebastianporteiro.com.ar" target="_blank">SEBASTIAN PORTEIRO</a>.<br />
Sitio alojado en <a href="http://www.000webhost.com/147501.html" target="_blank">000webhost</a>
 <p>
  <a href="http://validator.w3.org/check?uri=referer">
    <img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" class="titulares" style="border:0;width:57px;height:20px" />
        
</a>
  <a href="http://www.sebastianporteiro.com.ar" target="_blank"><img src="sebastianporteiro.gif" alt="Sebastian Porteiro" width="25px" height="25px" class="titulares" /></a></p>
<br />
</div>
<!-- FIN ULTIMO -->


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9285822-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:3, maxChars:30});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:3, maxChars:50});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {minChars:1, maxChars:50});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {counterType:"chars_remaining", counterId:"countsprytextarea1", minChars:20, maxChars:3000});
//-->
</script>

</body>
</html>
<?php
mysql_free_result($todo);
mysql_free_result($Recordlomasvisto);
mysql_free_result($Recordinsertarvisto);
?>