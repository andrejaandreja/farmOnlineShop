<?php
	include('header.php');
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "backend/db.php"; 
	/*$index = new Database("farma");
	$sql=$index->select();*/
?>
<div id="sadrzaj">
<?php
	$sql= mysql_query("SELECT * FROM proizvodi ORDER BY naziv1 DESC"); 
	echo "<Table class='container_12' id='grid_6' align='center' cellspacing='10' cellpadding='10'>";

	$broj = 2;
	while ($row = mysql_fetch_array($sql)) {
			$id=$row["id"];
			$naziv1=$row["naziv1"];
			$naziv2=$row["naziv2"];
		if ($broj%2==0) {
			echo "<tr>";	
		}
	
	echo '<Td align="center"><a href="vrsta.php?id=' .$id. '" class="cat">
				<img src="background/' .$id .'.jpg" height="180" width="400">
				<div class="cat_bot">
					<span>' .$naziv1.'</span>
					<em>'.$naziv2.'</em>
					<strong></strong>
				</div>
			</a></td>
		';	
	
	
	if ($broj%2==1) {
		echo "</tr>";	
	}
	
	$broj=$broj+1;
	}
	echo "</table>";
 
 ?>
</div>
<?php
	include "footer.php";
?>