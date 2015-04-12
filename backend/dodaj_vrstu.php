<?php
	include'header2.php';
	include 'login.php';
?><!--
<?php
/*
session_start();
$managerID = preg_replace('#[^0-9]#i','', $_SESSION["id"]);
$manager = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["manager"]);
$password = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION["password"]);

	include ('db.php');
$sql= mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password'");
$existCount=mysql_num_rows($sql);
if($existCount==0){
	echo "Sesija ne postoji u bazi";
	exit();
}
?>

<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');*/
?>-->
<?php
if(isset($_GET['deleteid'])){
echo 'Da li zelite da obrisete proizvod sa ID '.$_GET['deleteid'].'?<a href="dodaj_vrstu.php?yesdelete=' .$_GET['deleteid'].' "> Da</a>|
																		   <a href="dodaj_vrstu.php"> Ne</a>';
	exit();
}
if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM vrsta WHERE id='$id_to_delete'") or die (myslq_error);
	$pictodelete=("../vrste/$id_to_delete.jpg");
		if (file_exists($pictodelete)){
			unlink($pictodelete);
		}
		header("location: dodaj_vrstu.php");
		exit();
}
?>
<?php
	if(isset($_POST['zivotinja'])){

	$zivotinja= mysql_real_escape_string($_POST['zivotinja']);	
	$vrsta= mysql_real_escape_string($_POST['vrsta']);
	$cena= mysql_real_escape_string($_POST['cena']);
	$detalji= mysql_real_escape_string($_POST['detalji']);
	$sql= mysql_query("SELECT id FROM vrsta WHERE zivotinja='$zivotinja'");
	$productMatch=mysql_num_rows($sql);
	if($productMatch>0)
	{
	echo '<div id="sadrzaj-back">Ovim unosom bi duplirali unos: <a href ="dodaj_vrstu.php">Kliknite ovde</a>';
	exit();
	}
	$sql= mysql_query("INSERT INTO vrsta (id,zivotinja,vrsta,cena,detalji,date_added) VALUES ('','$zivotinja','$vrsta','$cena','$detalji',now())") or die(mysql_error());

	$pid= mysql_insert_id();
	$newname="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"../vrste/$newname");
	
	}
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
 
	$product_list="";
	$id = $_GET['id'];

	if (!isset($id)) die("error");
	$sql= mysql_query("SELECT * FROM vrsta WHERE zivotinja = '$id'"); 
	$productCount=mysql_num_rows($sql);
	if($productCount>0){
		while ($row=mysql_fetch_array($sql)) {
			$id=$row["id"];
			$vrsta=$row["vrsta"];
			$cena=$row["cena"];
			$detalji=$row["detalji"];
			$product_list.=
			'	<a href="../detalji.php?id=' .$id. '" class="cat">
				<img src="background/' .$id .'.jpg" height="160" width="400" alt>
				<div class="cat_bot">
					<span>' .$vrsta.'</span>
					<strong></strong>
				</div>
			</a>
		';
    } 
} else {
	$dynamicList = "Nemate proizvodja";
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
	<div id="sadrzaj-back">

		<div align="right" style="margin-top: 230px;">
			
		</div>
		
			<form action="dodaj_vrstu.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	  	<table width="90%" border="0" cellpadding="6">
	  			<tr>
	  					<tr>
	  				<td align="left">
	  					Selektujte proizvod:
	  				</td>
	  				<td align="left">
	  					<select name="zivotinja">
	  					<?php
							$selektujSveProizvode = mysql_query("SELECT * FROM proizvodi");
							while ($row = mysql_fetch_array($selektujSveProizvode)) {
							echo "<option value='$row[id]'>$row[naziv1] $row[naziv2]</option>";
		
							}

						?>

						</select><br /><br />
	 					
	  				</td>
	   			</tr>
	  				<td align="left">
	  					Vrsta:
	  				</td>
	  				<td align="left">
	  					<input name="vrsta" id="vrsta" type="text" size="60" maxlength="20"> 
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
	  				Slika:
	  			</td>
	  			<td align="left">
	  				<input type="file" name="fileField" id="fileField" value="Browse...">
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left">
	  				
	  			</td>
	  			<td align="left"><br></br>
	  				<input type="submit" value="Dodajte vrstu" onclick="javascript:return validateMyForm();"> 
	  			</td>
	  		</tr>
	  	</table>
	  </form>	
	  <table align="left" style="margin-left: 238px; position:absolute;">
			<tr><td><form action="index.php"><input type="submit" value="Nazad na dodavanje proizvoda"></form></td></tr>
	  </table>
	  <div><strong>Dodata vrsta: </strong></div>
		<div align="left" id= "product_list" stype="margin-left: 24px;">
				<?php
					echo "$product_list";	
				?>
		</div><br></br>
	</div>
	<?php
		include("../footer.php");
	?>
</div>
