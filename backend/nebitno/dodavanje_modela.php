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
if(isset($_GET['deleteid'])){
echo 'Da li zelite da obrisete proizvod sa ID '.$_GET['deleteid'].'?<a href="dodavanje_modela.php?yesdelete=' .$_GET['deleteid'].' "> Da</a>|
																		   <a href="dodavanje_modela.php"> Ne</a>';
	exit();
}
if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM modeli WHERE id='$id_to_delete'") or die (myslq_error);
	$pictodelete=("../modeli/$id_to_delete.jpg");
		if (file_exists($pictodelete)){
			unlink($pictodelete);
		}
		header("location: dodavanje_modela.php");
		exit();
}
?>
<?php
	if(isset($_POST['proizvodjac'])){
	$proizvodjac= mysql_real_escape_string($_POST['proizvodjac']);
	$serija= mysql_real_escape_string($_POST['serija']);
	$model= mysql_real_escape_string($_POST['model']);
	$cena= mysql_real_escape_string($_POST['cena']);
	$detalji= mysql_real_escape_string($_POST['detalji']);
	//$productMatch=mysql_num_rows($sql);
//if($productMatch==0)
//	echo 'Ovim unosom bi duplirali unos: <a href ="dodavanje_modela.php">Kliknite ovde</a>';
//	exit();
//}
	$sql= mysql_query("INSERT INTO modeli (id,proizvodjac,serija,model,cena,detalji,date_added) VALUES ('','$proizvodjac','$serija','$model','$cena','$detalji',now())") or die(mysql_error());
	$pid= mysql_insert_id();
	$newname="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"../slike_vozila/$newname");
	
	}
?>
<?php
	$product_list="";
	$sql= mysql_query("SELECT * FROM modeli ORDER BY proizvodjac"); 
	$productCount=mysql_num_rows($sql);
	if($productCount>0){
		while ($row=mysql_fetch_array($sql)) {
			$id=$row["id"];
			$serija=$row["serija"];
			$model=$row["model"];
			$proizvodjac=$row["proizvodjac"];
			$date_added= strftime("%b %d, %Y", strtotime($row['date_added']));
			$product_list.="Product ID: $id - <strong>$model</strong> - <em>Added $date_added</em>&nbsp;&nbsp;&nbsp; <a href='edit_modela.php?pid=$id'>edit</a> &bull; 
																	  <a href='dodavanje_modela.php?deleteid=$id'>delete</a><br />";

		}
	} else {
	 $product_list="Jos uvek niste dodali model";
	}
?>
<html>
<head><title>Dodavanje modela</title>
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
			<table align="right">
			<tr><td><form action="dodavanje_proizvodjaca.php#forma"><input type="submit" value="Dodajte proizvodjaca"></form></td></tr>
			<tr><td><form action="dodavanje_modela.php#forma"><input type="submit" value="Dodajte model"></form></td></tr>
			</table>
		</div>
		<div id="inventory"><strong>Dodavanje modela</strong></div>
		<div align="left" id= "product_list" stype="margin-left: 24px;">
				<?php
					echo "$product_list";	
				?>
		</div><br></br>
			<form action="dodavanje_modela.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
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
	  					<input name="model" id="model" type="text" size="60" maxlength="20"> 
	  				</td>
				</tr>
	  		<tr>
	  			<tr>
	  			<td align="left">
	  				Naziv serije
	  			</td>
	  			<td align="left">
	  				<input name="serija" id="serija" type="text" size="60" maxlength="20"> 
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				Cena
	  			</td>
	  			<td align="left">
	  				<input name="cena" id="cena" type="text" size="30" maxlength="20"> 
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				Detalji
	  			</td>
	  			<td align="left">
	  				<textarea  style="resize:none" maxlength="150" name="detalji" rows="6" cols="32"></textarea>
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
	  			<td align="left"><br></br>
	  				<input type="submit" value="Dodajte model" onclick="javascript:return validateMyForm();"> 
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