<?php
	include 'header2.php';
	include 'login.php';	
?>
<?php 
if (isset($_POST['naziv1'])) {
	
	$pid = mysql_real_escape_string($_POST['thisID']);
    $naziv1 = mysql_real_escape_string($_POST['naziv1']);
    $naziv2 = mysql_real_escape_string($_POST['naziv2']);
	
	$sql = mysql_query("UPDATE proizvodi SET naziv1='$naziv1', naziv2='$naziv2' WHERE id='$pid'");
	if ($_FILES['fileField']['tmp_name'] != "") {
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../background/$newname");
	}
	header("location: index.php"); 
    exit();
}
?>

<?php 
if (isset($_GET['id'])) {
	$targetID = $_GET['id'];
    $sql = mysql_query("SELECT * FROM proizvodi WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql);
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             /*$id=$row["id"];*/
			 $naziv1 = $row["naziv1"];
			 $naziv2 = $row["naziv2"];
			 
			 }
    } else {
	    echo "Taj proizvod ne postoji.";
		exit();
    }
}
?>

<div id="sadrzaj-back">
		<div id="sadrzaj-forma">
		<div><strong>Dodavanje proizvoda</strong></div>
		<div align="left" id= "product_list" stype="margin-left: 24px;">
				
		</div><br></br>
	<form action="izmena_proizvoda.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	  	<table width="90%" border="0" cellpadding="6">
	  		<tr>
	  				<td align="left">
	  					Proizvod:<br>
	  				</td>
	  				<td align="left">
	  					Naziv: <input name="naziv1" id="naziv1" type="text" size="60" value="<?php echo $naziv1; ?>"><br>
	  					Vrsta: <input name="naziv2" id="naziv2" type="text" size="60" value="<?php echo $naziv2; ?>">
	  				</td>
	   		</tr>
	  		<tr>
	  			<td align="left">
	  				Slika proizvoda:
	  			</td>
	  			<td align="left">
	  				<input type="file" name="fileField" value="Browse...">
	  			</td>
	  		</tr>
	  		<tr>
	  			<td align="left"><br></br>
	  				 <input name="thisID" type="hidden" value="<?php echo $targetID; ?>">
	  				<input type="submit" value="Izvrsite izmene"> 
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