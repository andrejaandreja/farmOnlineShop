 <?php
$mysql_server = "localhost";
$mysql_user = "farma";
$mysql_password = "farmafarma";
$mysql_db = "farma";
if (!$db=mysql_connect($mysql_server, $mysql_user, $mysql_password)) {
die ("<p>Spajanje na mysql server je bilo neuspešno</p>");
}
if (!mysql_select_db($mysql_db, $db))
{
die ("<p>Greška pri odabiru baze</p>");
} else {
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION='utf8_unicode_ci'");
}
?>