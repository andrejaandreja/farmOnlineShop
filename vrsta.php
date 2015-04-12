<?php
	include('header.php');
?>
<div id="sadrzaj">
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "backend/db.php"; 
	$id = $_GET['id'];

if (!isset($id)) die("error");
	$sql= mysql_query("SELECT * FROM vrsta WHERE zivotinja = '$id'"); 
	$productCount=mysql_num_rows($sql);
		echo "<Table class='container_vrsta_12' id='grid_vrsta_6' align='center' cellspacing='10' cellpadding='10'>";

		$broj = 5;
		while ($row = mysql_fetch_array($sql)) {
			$id=$row['id'];
			$vrsta=$row["vrsta"];
	if ($broj%5==0) {
		echo "<tr>";	
	}
	
	echo '<Td align="center"><a href="detalji.php?id=' .$id. '" class="cat_vrsta">
				<img src="vrste/' .$id .'.jpg" height="130" width="230">
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

mysql_close();
?>
</div>
<?php
	include('footer.php');
?>