<?php 
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
require_once(__DIR__ . '/connections/conexion.php'); ?>
<?php 
$fecha=getdate();
$dia=$fecha['year']."-".$fecha['mon']."-".$fecha['mday'];



mysql_select_db($database_conexion, $conexion);
$query_Recordlomasvisto = "SELECT * FROM Post WHERE CodPost > (SELECT MAX( CodPost ) -20 FROM Post) ORDER BY visitas DESC";
$Recordlomasvisto = mysql_query($query_Recordlomasvisto, $conexion) or die(mysql_error());
$row_Recordlomasvisto = mysql_fetch_assoc($Recordlomasvisto);
?>
<rss version="2.0">
<channel>
	<title>Escribiloquequieras::Lo mas visto</title>
	<link>http://escribiloquequieras.com.ar</link>
	<description>Lo mas visto</description>
	<pubDate><?php echo $dia?></pubDate>

	<?php do { ?>
	<item>
		<title><?php echo $row_Recordlomasvisto['titulo']?></title>
		<link>http://www.escribiloquequieras.com.ar/temas.php?escribieron=<?php echo $row_Recordlomasvisto['titulo'];?>
</link>
		<description>
			<? if ($row_Recordlomasvisto['categoria']=='texto')	{
				 echo $row_Recordlomasvisto['asunto'];
			}
			else if ($row_Recordlomasvisto['categoria']=='imagenes')	{
			 	echo $row_Recordlomasvisto['asunto'];
			}?>
		</description>
		<guid isPermaLink="true"><?php echo $dia?>_<?php echo $row_Recordlomasvisto['CodPost'];?></guid>
		<pubDate><?php echo $dia?></pubDate>
		
	</item>
	  <?php } while ($row_Recordlomasvisto = mysql_fetch_assoc($Recordlomasvisto)); ?>


</channel>
</rss>
