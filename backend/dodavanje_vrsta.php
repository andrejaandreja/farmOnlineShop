<?php
	include 'header2.php';
	include 'login.php';
?>

<!--<?php /*
$product_list = "";

$sql = mysql_query("SELECT * FROM proizvodi WHERE id='$id'");
$productCount = mysql_num_rows($sql);
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $naziv1 = $row["naziv1"];
			 $naziv2 = $row["naziv2"];
			 $product_list .= $naziv1 . " " .$naziv2;
    }
} else {
	$product_list = "Nema proizvoda u bazi";
}*/
?>-->
<?php 
if(isset($_POST['zivotinja'])){
	$zivotinja= mysql_real_escape_string($_POST['zivotinja']);
	$vrsta= mysql_real_escape_string($_POST['vrsta']);
	$cena= mysql_real_escape_string($_POST['cena']);
	$detalji= mysql_real_escape_string($_POST['detalji']);
	$sql= mysql_query("SELECT id FROM vrsta WHERE vrsta='$vrsta'");
		$productMatch = mysql_num_rows($sql);
    if ($productMatch > 0) {
		echo 'Ovim bi duplirali unos <a href="dodavanje_vrsta.php">Kliknite ovde</a>';
		exit();
	}
	$sql= mysql_query("INSERT INTO vrsta (id,zivotinja,vrsta,cena,detalji,date_added) VALUES ('','$zivotinja','$vrsta','$cena','$detalji',now())") or die(mysql_error());
 	$pid = mysql_insert_id();
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../vrste/$newname");
	header("location: dodavanje_vrsta.php"); 
    exit();
}
?>
	<div id="sadrzaj-back">
			<div id="sadrzaj-forma">
	<form action="dodavanje_vrsta.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	  	<table width="90%" border="0" cellpadding="6">
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
	  					<input name="vrsta" id="vrsta" type="text" size="30" maxlength="20"> 
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
	  <div id="lista" align="center">Lista dodatih vrsta: </div>
	<?php
if(isset($_GET['deleteid'])){
echo '<div id="lista">Da li zelite da obrisete proizvod? <a href="dodavanje_vrsta.php?yesdelete=' .$_GET['deleteid'].' "> Da</a>|
																		   <a href="dodavanje_vrsta.php"> Ne</a></div>';
	exit();
}
if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM vrsta WHERE id='$id_to_delete'") or die (myslq_error);
	$pictodelete=("../vrsta/$id_to_delete.jpg");
		if (file_exists($pictodelete)){
			unlink($pictodelete);
		}
		header("location: dodavanje_vrsta.php");
		exit();
}
?>

 <?php
	/*$index = new Database("farma");
	$sql=$index->select();*/
	$sql= mysql_query("SELECT * FROM vrsta ORDER BY vrsta DESC"); 
	echo "<Table class='container_12_vrsta' id='grid_vrsta_6' align='center' cellspacing='10' cellpadding='10'>";
	
	$broj = 5;
	while ($row = mysql_fetch_array($sql)) {
			$id=$row['id'];
			$vrsta=$row["vrsta"];
			$zivotinja = $row["zivotinja"];
			$detalji = $row["detalji"];
			$cena = $row["cena"];
		if ($broj%5==0) {
			echo "<tr>";	
		}
	
	echo '<td id="izmeni"><a href="izmena_vrsta.php?id=' .$id. '"><img src="../background/izmeni.jpg" alt="izmeni" height="50" width="50"></td>
		  <td id="delete_vrsta"><a href="dodavanje_vrsta.php?deleteid=' .$id .'"><img src="../background/delete.jpg" alt="izmeni" height="50" width="50"></td>
			<Td align="center"><a href="../detalji.php?id='.$id.'" class="cat_vrsta">
				<img src="../vrste/' .$id .'.jpg" height="130" width="230">
				<div class="cat_bot_vrsta">
					<span>' .$vrsta.'</span>
					<strong></strong>
				</div>
			</a></td>
		';	
	
	
	if ($broj%5==4) {
		echo "</tr>";	
	}
	
	$broj=$broj+1;
	}

	echo "</table>";

 
 ?>
</div>
</div>
<!--<html>
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
</script>-->
	
<?php
		include("../footer.php");
?>