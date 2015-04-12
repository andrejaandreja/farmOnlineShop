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
	if(isset($_POST['proizvodjac'])){
		$pid= mysql_real_escape_string($_POST['ovajID']);
		$proizvodjac= mysql_real_escape_string($_POST['proizvodjac']);
		$serija= mysql_real_escape_string($_POST['serija']);
		$model= mysql_real_escape_string($_POST['model']);
		$cena= mysql_real_escape_string($_POST['cena']);
		$detalji= mysql_real_escape_string($_POST['detalji']);
		
		$sql= mysql_query("UPDATE modeli SET proizvodjac='$proizvodjac',serija='$serija',model='$model',cena='$cena',detalji='$detalji' WHERE id='$pid'");

	if($_FILES['fileField']['tmp_name'] != "") {
		$newname="$pid.jpg";
		move_uploaded_file($_FILES['fileField']['tmp_name'],"../pictureG/$newname");
		}
		header("location: dodavanje_modela.php");
		exit();
}
?>
<?php

if(isset($_GET['pid'])){
	$targetID= $_GET['pid'];
	$sql= mysql_query("SELECT * FROM modeli WHERE id='$targetID'"); 
	$productCount=mysql_num_rows($sql);
	if($productCount>0){
		while ($row=mysql_fetch_array($sql)) {
			$id=$row["id"];
			$proizvodjac=$row["proizvodjac"];
			$serija=$row["serija"];
			$model=$row["model"];
			$cena=$row["cena"];
			$detalji=$row["detalji"];
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
	  <form action="edit_modela.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	  	<table width="90%" border="0" cellpadding="6">
	  				<tr>
	  				<td align="left">
	  					Pripada proizvodjacu:
	  				</td>
	  				<td align="left">
	  					<select name="proizvodjac">
	  					<?php
							$selektujSveProizvodjace = mysql_query("SELECT * FROM proizvodjaci");
							while ($row = mysql_fetch_array($selektujSveProizvodjace)) {
							echo "<option value='$row[id]'>$row[naziv]</option>";
		
							}

						?>

						</select><br /><br />
	 					
	  				</td>
	   			</tr>
	   		  	<tr>
	  				<td align="left">
	  					Naziv modela
	  				</td>
	  				<td align="left">
	  					<input name="model" id="model" type="text" size="60" maxlength="20" value="<?php echo $model; ?>"> 
	  				</td>
				</tr>
	  		<tr>
	  			<tr>
	  			<td align="left">
	  				Naziv serije
	  			</td>
	  			<td align="left">
	  				<input name="serija" id="serija" type="text" size="60" maxlength="20" value="<?php echo $serija; ?>"> 
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				Cena
	  			</td>
	  			<td align="left">
	  				<input name="cena" id="cena" type="text" size="30" maxlength="20" value="<?php echo $cena; ?>"> 
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				Detalji
	  			</td>
	  			<td align="left">
	  				<textarea  style="resize:none" maxlength="150" name="detalji"  rows="6" cols="32"><?php echo $detalji; ?></textarea>
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				Slika modela:
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