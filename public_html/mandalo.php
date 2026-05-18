<?php require_once('recaptchalib.php');
$privatekey = "6Lf0_vASAAAAAGl6NfaNH0fZwwvxnqgGAmmxvEcN";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
  die (header('location: malcaptcha.html'));
}?>
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
Header ("Location:mensajenviado.php");


?> 
