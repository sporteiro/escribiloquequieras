<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verify-v1" content="jLzDZBjVtNWtOfn2f2yKtMrlDZLI3BMhjT5OwjtINv4=" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="escribi lo que quieras sobre cualquier tema, escribi, lo, que, quieras" />
<meta name="description" content="escribi lo que quieras" />
<title>Escribi lo que quieras</title>
<link href="../style/estilo.css" rel="stylesheet" type="text/css" />
<link href="../style/estilo_2026.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/favicon.ico"/>
<link href="../style/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../javascript/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../style/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="../javascript/SpryValidationTextarea.js" type="text/javascript"></script>
<script type="text/javascript">
function denunciar()	{
	document.getElementById("asunto").innerHTML="Quisiera reportar un abuso en el post titulado \"<?=$_GET['denunciar']?>\" por el motivo siguiente:";
	}
</script>
</head>
<body
<?php 
if (isset($_GET['denunciar']))	{
echo "onload='denunciar();'";
}
?>>


<div id="laquetiene">
              <div id="logo"><a href="index.php" target="_self"><img src="../img/escribi.png" alt="escribi lo que quieras" class="titulares" /></a>
  </div>
</div>

<div id="cnugida">
     <div id="adinugui">
           <div id="termini"></div>
       <div align="right" id="conti"></div>
  </div>
  <div id="glugle">
    <p>&nbsp;</p>
  </div>
  <div id="contactos">
 <span class="trasfon"> <br />Para cualquier consulta, puede enviarnos un e-mail rellenando este formulario. Nos pondremos en contacto con usted en la mayor brevedad posible. Gracias de antemano por su atención.</span>
    <br />  
      <form id="fcontacto" name="fcontacto" method="post" action="mandalo.php">
      <br />
      <span id="sprytextfield1"> 
        <label><span class="titulares">NOMBRE<br />
        </span>
          <input name="nombre" type="text" class="imputis" id="nombre" tabindex="1" size="40" maxlength="40" />
        </label><br />
          <span class="textfieldRequiredMsg">Todos los campos son obligatorios</span><span class="textfieldMinCharsMsg">Muy pocos caracteres</span><span class="textfieldMaxCharsMsg"> Demasiados caracteres</span></span>
        <p>
        <span id="sprytextfield2"> 
          <label><span class="titulares">E-MAIL</span>
          <br />
          <input name="email" type="text" class="imputis" id="email" tabindex="2" size="40" maxlength="40" />
          </label> <br /><span class="textfieldRequiredMsg">Todos los campos son obligatorios</span><span class="textfieldInvalidFormatMsg">Debe ser un E-mail</span></span>
        </p>
        <p><span id="sprytextarea1">
          <label><span class="titulares">ASUNTO<br />
          </span>
          <textarea name="asunto" cols="45" rows="6" class="imputis" id="asunto" tabindex="3"></textarea>
          </label></span>
        </p><br />
      <input name="origen" type="hidden" id="origen" value="ESCRIBILOQUEQUIERAS" />
      <div class="imputis" style="margin: 0 auto;">
      <?php require_once(__DIR__ . '/recaptcha.php'); recaptcha_render_widget(); ?>
      </div>
     
        <p>
          <label>
          <input name="listo" type="submit" class="botones" id="listo" tabindex="4" value="Enviar E-mail" />
          </label>
        </p>
      </form>
       <p>&nbsp;</p>
      <br /><br /><br /><br /><br />
      </div>
      <br />
  </div>
  <br />

<br />

<div style="clear:both;"></div>
<!-- INICIO ULTIMO -->

<div id="ultimo">
<div class="letrasnormales">
        	<a href="../html/terminos.html">Términos y condiciones generales de uso</a> | <a href="/temas.php?escribieron=%BFque%20es%20Escribiloquequieras?">&iquest;Qu&eacute; es es escribiloquequieras? </a> | <a href="contacto.php">Contactar con el equipo de desarrollo</a>
		</div>
        <br />
TODOS LOS DERECHOS RESERVADOS. Escribiloquequieras no es responsable del contenido.<br />
DISE&Ntilde;O Y DESARROLLO DEL SITIO: <a href="https://www.sebastianporteiro.com" target="_blank">SEBASTIAN PORTEIRO</a>.<br />
<a href="https://www.sebastianporteiro.com/img/logo.png" target="_blank"><img src="https://www.sebastianporteiro.com/img/logo.png" alt="Sebastian Porteiro" width="25px" height="25px" class="titulares" /></a></p>
<br />
</div>
<!-- FIN ULTIMO -->
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:3, maxChars:30});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {counterType:"chars_remaining", counterId:"countsprytextarea1", minChars:20, maxChars:2500});
//-->
</script>
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
