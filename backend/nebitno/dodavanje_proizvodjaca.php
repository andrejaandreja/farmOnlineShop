<?php
session_start();
$managerID = preg_replace('#[^0-9]#i','', $_SESSION["id"]);
$manager = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["manager"]);
$password = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["password"]);

	include ('connect_to_mysql.php');
$sql= mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password'");
$existCount=mysql_num_rows($sql);
if($existCount==0){
	echo "Sesija ne postoji";
	exit();
}
?>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>
<?php
if(isset($_GET['deleteid'])){
echo 'Da li zelite da obrisete proizvod sa ID '.$_GET['deleteid'].'?<a href="dodavanje_proizvodjaca.php?yesdelete=' .$_GET['deleteid'].' "> Da</a>|
																		   <a href="dodavanje_proizvodjaca.php"> Ne</a>';
	exit();
}
if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM proizvodi WHERE id='$id_to_delete'") or die (myslq_error);
	$pictodelete=("../pictureG/$id_to_delete.jpg");
		if (file_exists($pictodelete)){
			unlink($pictodelete);
		}
		header("location: dodavanje_proizvodjaca.php");
		exit();
}
?>
<?php
	if(isset($_POST['naziv1'])){
		$naziv= mysql_real_escape_string($_POST['naziv1']);
	$sql= mysql_query("SELECT id FROM proizvodi WHERE naziv1='$naziv1'");

	$sql= mysql_query("INSERT INTO proizvodi (naziv1,naziv2) 
									VALUES ('$naziv1','$naziv2'") or die(mysql_error());
	$pid= mysql_insert_id();
	$newname="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"../background/$newname");
	
	}
?>
<?php
	$product_list="";
	$sql= mysql_query("SELECT * FROM proizvodi ORDER BY naziv1 DESC"); 
	$productCount=mysql_num_rows($sql);
	if($productCount>0){
		while ($row=mysql_fetch_array($sql)) {
			$id=$row["id"];
			$naziv1=$row["naziv1"];
			$naziv2=$row["naziv2"];
			$product_list.=
			'<div class="container_12">
		<div class="grid_6">
			<a href="pilici.php?id=' .$id. '" class="cat">
				<img src="background/' .$id .'jpg" height="160" width="400" alt>
				<div class="cat_bot">
					<span>' .$naziv1.'</span>
					<em>'.$naziv2.'</em>
					<strong></strong>
				</div>
			</a>
		</div>';

		}
	} else {
	 $product_list="Jos uvek niste dodali proizvodjaca";
	}
?>
<html>
<head><title>Dodavanje proizvoda</title>
<script type="text/javascript" language="javascript"> 
function validateMyForm ( ) { 
    var isValid = true;
    if ( document.form1.uName.value == "" ) { 
	    alert ( "Please type your Name" ); 
	    isValid = false;
    } else if ( document.form1.uName.value.length < 8 ) { 
            alert ( "Your name must be at least 8 characters long" ); 
            isValid = false;
    } else if ( document.form1.uEmail.value == "" ) { 
            alert ( "Please type your Email" ); 
            isValid = false;
    } else if ( document.form1.uCity.value == "" ) { 
            alert ( "Please type your City" ); 
            isValid = false;
    }
    return isValid;
}
</script>
</head>
<link rel="stylesheet" type="text/css" href="../style.css" />
<body>
<div align="center" id="mainWrapper">
	<?php
		include("header2.php");
	?>
	<div id="sadrzaj-dodavanje-pilica">

		<div align="right" stype="margin-right: 32px;">
			<table align="right">
			<tr><td><form action="dodavanje_proizvodjaca.php#forma"><input type="submit" value="Dodajte proizvodjaca"></form></td></tr>
			<tr><td><form action="dodavanje_modela.php#forma"><input type="submit" value="Dodajte model"></form></td></tr>
			</table>
		</div>
		<div id="inventory"><strong>Dodavanje proizvodjaca</strong></div>
		<div align="left" id= "product_list" stype="margin-left: 24px;">
				
		</div><br></br>
	<form action="dodavanje_proizvodjaca.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	  	<table width="90%" border="0" cellpadding="6">
	  		<tr>
	  				<td align="left">
	  					Proizvod:<br>
	  				</td>
	  				<td align="left">
	  					Prva rec u nazivu: <input name="naziv1" id="naziv1" type="text" size="60"><br>
	  					Prva rec u nazivu: <input name="naziv2" id="naziv2" type="text" size="60">
	  				</td>
	   		</tr>
	  		<tr>
	  			<td align="left">
	  				Slika proizvoda:
	  			</td>
	  			<td align="left">
	  				<input type="file" name="fileField" id="fileField" value="Browse...">
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left"><br></br>
	  				<input type="submit" value="Dodajte proizvod" onclick="javascript:return validateMyForm();"> 
	  			</td>
	  		</tr>
	  	</table>
	</form>	
	<B>VAZI PROIZVODI:</B>
	<?php
					echo "$product_list";	
				?>
	</div>
	<?php
		include("footer.php");
	?>
</div>
</body>
</html>