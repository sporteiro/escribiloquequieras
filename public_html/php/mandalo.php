<?php
require_once(__DIR__ . '/recaptcha.php');
recaptcha_require_valid();
?>
<?php

$mail='LUJOCAMPANACCI@GMAIL.COM';


$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$asunto = $_POST['asunto'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$origen = $_POST['origen'] ?? 'ESCRIBILOQUEQUIERAS';

$message = "
nombre:" . $nombre . "
email:" . $email . "
asunto:" . $asunto . "
ip:" . $ip;

$replyTo = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';
$remitente = "MIME-Version: 1.0\r\n";
$remitente .= "Content-Type: text/plain; charset=UTF-8\r\n";
$remitente .= "From: Escribiloquequieras <noreply@escribiloquequieras.com>\r\n";
if ($replyTo !== '') {
    $remitente .= 'Reply-To: ' . $replyTo . "\r\n";
}

if (mail($mail, 'ESCRIBILOQUEQUIERAS.COM', $message, $remitente)) {
    header('Location: ../html/mensajenviado.html');
    exit;
}


?> 
