<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_tema = "****";
$database_tema = "****";
$username_tema = "****";
$password_tema = "****";

$tema = mysql_pconnect($hostname_tema, $username_tema, $password_tema) or header("Location: 404.html"); 

//NO MOSTRAR EL ERROR EN REMOTO
//$tema = mysql_pconnect($hostname_tema, $username_tema, $password_tema) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
