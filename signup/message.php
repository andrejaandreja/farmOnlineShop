<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if($msg == "aktivacija_neuspesna"){
	$message = '<h2>Aktivacija neuspesna</h2>Aktivacija je neuspesna. Bicete obavesteni o mogucim greskama!';
} else if($msg == "aktivacija_uspesna"){
	$message = '<h2>Aktivacija uspesna</h2> Vas nalog je uspesno aktiviran. <a href="login.php">Kliknite ovde za logovanje.</a>';
} else {
	$message = $msg;
}
?>
<div><?php echo $message; ?></div>
