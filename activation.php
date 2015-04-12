<?php
if (isset($_GET['id']) && isset($_GET['u']) && isset($_GET['e']) && isset($_GET['p'])) {

    include_once("db.php");
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
	$e = mysqli_real_escape_string($db, $_GET['e']);
	$p = mysqli_real_escape_string($db, $_GET['p']);
	
	if($id == "" || strlen($u) < 3 || strlen($e) < 5 || strlen($p) < 5){
		
		header("location: message.php?msg=nedovoljna_duzina_karaktera");
    	exit(); 
	}
	/*provera aktivacije*/
	$sql = "SELECT * FROM users WHERE id='$id' AND username='$u' AND email='$e' AND password='$p' LIMIT 1";
    $query = mysqli_query($db, $sql);
	$numrows = mysqli_num_rows($query);

	if($numrows == 0){

		header("location: message.php?msg=ne_postoji");
    	exit();
	}
	// else postoji
	$sql = "UPDATE users SET activated='1' WHERE id='$id' LIMIT 1";
    $query = mysqli_query($db, $sql);
	// dupla provera da nije vec aktiviran
	$sql = "SELECT * FROM users WHERE id='$id' AND activated='1' LIMIT 1";
    $query = mysqli_query($db, $sql);
	$numrows = mysqli_num_rows($query);
	// Evaluate the double check
    if($numrows == 0){
		
        header("location: message.php?msg=aktivacija_neuspesna");
    	exit();
    } else if($numrows == 1) {
		
        header("location: message.php?msg=aktivacija_uspesna");
    	exit();
    }
} else {
	/*ili da se posalje na mail koje su greske*/
	header("location: message.php?msg=missing_GET_variables");
    exit(); 
}
?>
