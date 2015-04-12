<?php
	include 'header2.php';
	include 'login.php';
?>
<?php
	if(isset($_POST['zivotinja'])){
		$zivotinja= mysql_real_escape_string($_POST['zivotinja']);
		$vrsta= mysql_real_escape_string($_POST['vrsta']);
		$detalji= mysql_real_escape_string($_POST['detalji']);
		$cena= mysql_real_escape_string($_POST['cena']);
	$sql= mysql_query("UPDATE vrsta SET zivotinja='$zivotinja', 
		vrsta='$vrsta',detalji='$detalji',cena='$cena' WHERE zivotinja='$id'");

	if($_FILES['fileField']['tmp_name'] != "") {
		$newname="$pid.jpg";
		move_uploaded_file($_FILES['fileField']['tmp_name'],"../vrsta/$newname");
		}
		header("location: dodavanje_vrsta.php");
		exit();
}
?>
<?php
if(isset($_GET['zivotinja'])){
	$zivotinja= $_GET['zivotinja'];
	$sql= mysql_query("SELECT * FROM vrsta WHERE zivotinja = '$id'");  
	$productCount=mysql_num_rows($sql);
	if($productCount>0){
		while ($row=mysql_fetch_array($sql)) {
			//$id=$row["id"];
			$zivotinja=$row["zivotinja"];
			$vrsta=$row["vrsta"];
			$detalji=$row["detalji"];
			$cena=$row["cena"];
			$date_added= strftime("%b %d, %Y", strtotime($row['date_added']));

		}
	} else {
	 	echo "Proizvod ne postoji";
	 	exit();
	}
}
?>
	<div id="sadrzaj-back">
	 <div id="sadrzaj-forma">
	 	<div id="lista" align="center"> Izmena proizvoda: </div><br>
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
	  					<input name="vrsta" id="vrsta" type="text" size="30" maxlength="20" value="<?php echo $vrsta; ?>"> 
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
	  	<?php
		include("../footer.php");
	?>
</div>
</body>
</html>