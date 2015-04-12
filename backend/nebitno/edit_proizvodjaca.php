<?php
session_start();
$managerID = preg_replace('#[^0-9]#i','', $_SESSION["id"]);
$manager = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["manager"]);
$password = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["password"]);

	include ('connect_to_mysql.php');
$sql= mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password'");
$existCount=mysql_num_rows($sql);
if($existCount==0){
	echo "Sesija ne postoji u bazi";
	exit();
}
?>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>

<?php
	if(isset($_POST['naziv'])){
		$pid= mysql_real_escape_string($_POST['ovajID']);
		$naziv= mysql_real_escape_string($_POST['naziv']);
		$sql= mysql_query("UPDATE proizvodjaci SET naziv='$naziv' WHERE id='$pid'");

	if($_FILES['fileField']['tmp_name'] != "") {
		$newname="$pid.jpg";
		move_uploaded_file($_FILES['fileField']['tmp_name'],"../pictureG/$newname");
		}
		header("location: dodavanje_proizvodjaca.php");
		exit();
}
?>
<?php

if(isset($_GET['pid'])){
	$targetID= $_GET['pid'];
	$sql= mysql_query("SELECT * FROM proizvodjaci WHERE id='$targetID'"); 
	$productCount=mysql_num_rows($sql);
	if($productCount>0){
		while ($row=mysql_fetch_array($sql)) {
			$id=$row["id"];
			$naziv=$row["naziv"];
			$date_added= strftime("%b %d, %Y", strtotime($row['date_added']));

		}
	} else {
	 	echo "Taj proizvodjac ne postoji";
	 	exit();
	}
}
?>
<html>
<head><title>Editovanje proizvodjaca</title>
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
		include("header.php");
	?>
	<div id="pageContent">
			<div align="right" stype="margin-right: 32px;">
				<form action="dodavanje_proizvodjaca.php#forma"><input type="submit" value="Dodajte novog proizvodjaca"></form>
				<form action="dodavanje_modela.php#forma"><input type="submit" value="Dodajte novi model"></form>
			</div>
			<a name="inventoryForm" id="inventoryForm"></a>
	  Editovanje proizvodjaca<br></br>
	  <form action="edit_proizvodjaca.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	  	<table width="90%" border="0" cellpadding="6">
	  		<tr>
	  			<td align="left">
	  				Naziv
	  			</td>
	  			<td align="left">
	  				<input name="naziv" id="naziv" type="text" size="60" value="<?php echo $naziv; ?>" />  
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				Slika proizvodjaca:
	  			</td>
	  			<td align="left">
	  				<input type="file" name="fileField" id="fileField" value="Browse...">
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				
	  			</td>
	  			<td align="left">
	  				<input name="ovajID" type="hidden" value="<?php echo $targetID; ?>" />
	  				<input type="submit" value="Promeni" onclick="javascript:return validateMyForm();"> 
	  			</td>
	  		</tr>
	  	</table>
	  </form>	
	</div>
	<?php
		include("footer.php");
	?>
</div>
</body>
</html>