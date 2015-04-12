<?php
	include 'header2.php';
	include 'login.php';
?>
<?php
if(isset($_GET['deleteid'])){
echo 'Da li zelite da obrisete proizvod sa ID '.$_GET['deleteid'].'?<a href="dodavanje_proizvoda.php?yesdelete=' .$_GET['deleteid'].' "> Da</a>|
																		   <a href="dodavanje_proizvoda.php"> Ne</a>';
	exit();
}
if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM proizvodi WHERE id='$id_to_delete'") or die (myslq_error);
	$pictodelete=("../background/$id_to_delete.jpg");
		if (file_exists($pictodelete)){
			unlink($pictodelete);
		}
		header("location: dodavanje_proizvodjaca.php");
		exit();
}
?>

<?php 
if(isset($_POST['naziv1'])){
	$naziv1= mysql_real_escape_string($_POST['naziv1']);
	$naziv2= mysql_real_escape_string($_POST['naziv2']);
	
	$sql= mysql_query("SELECT id FROM proizvodi WHERE naziv1='$naziv1' AND naziv2='$naziv2'");
		$productMatch = mysql_num_rows($sql);
    if ($productMatch > 0) {
		echo 'Ovim bi duplirali unos <a href="dodavanje_proizvoda.php">Kliknite ovde</a>';
		exit();
	}
	$sql= mysql_query("INSERT INTO proizvodi (id,naziv1,naziv2,date_added) VALUES ('','$naziv1','$naziv2',now())") or die(mysql_error());
 	$pid = mysql_insert_id();
	$newname = $pid.".jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../background/$newname");
	header("location: dodavanje_proizvoda.php"); 
    exit();
}
?>
<div id="sadrzaj-back">
		<div id="sadrzaj-forma">
		<div><strong>Dodavanje proizvoda</strong></div>
		<div align="left" id= "product_list" stype="margin-left: 24px;">
				
		</div><br></br>
	<form action="dodavanje_proizvoda.php" enctype="multipart/form-data" method="post">
	  	<table width="90%" border="0" cellpadding="6">
	  		<tr>
	  				<td align="left">
	  					Proizvod:<br>
	  				</td>
	  				<td align="left">
	  					Naziv: <input name="naziv1" type="text" size="60"><br>
	  					Vrsta: <input name="naziv2" type="text" size="60">
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
	  			<td align="left"><br></br>
	  				<input type="submit" value="Dodajte proizvod"> 
	  			</td>
	  		</tr>
	  	</table>
	  	
	</form>	
	<form action="logout.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	  	<table width="90%" border="0" cellpadding="6">
	  		<tr>
	  			<td align="left"><br></br>
	  				<input type="submit" value="Log out"> 
	  			</td>
	  		</tr>
	  	</table>
	  	
	</form>	
</div>
</div>
<?php
	include "../footer.php";
?>