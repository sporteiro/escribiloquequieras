<?php
require_once(__DIR__ . '/recaptcha.php');
recaptcha_require_valid();
?>
<?php

$mail='LUJOCAMPANACCI@GMAIL.COM';


$nombre = $_POST['nombre'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$ip = $_SERVER['REMOTE_ADDR'];
$origen = $_POST['origen'];

$message = "
nombre:".$nombre."
email:".$email."
asunto:".$asunto."
ip:".$ip."";

$remitente .= "From: $origen";
if (mail($mail,"ESCRIBILOQUEQUIERAS.COM",$message,$remitente))
Header ("Location: ../html/mensajenviado.html");


?> 
