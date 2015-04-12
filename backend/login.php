<?php 
	session_start();
if (!isset($_SESSION["manager"])){
	header("location: admin_login.php");
	exit();
}
$managerID = preg_replace('#[^0-9]#i','', $_SESSION["id"]);
$manager = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["manager"]);
$password = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["password"]);

include "db.php";
/*$index = new Database("farma");
$sql=$index->select();*/
$sql= mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount==0){
	echo "Niste dolelili usera u bazi";
	exit();
}
?>

