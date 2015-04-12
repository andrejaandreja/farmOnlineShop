<div id="sadrzaj">
	<?php
	/*$index = new Database("farma");
	$sql=$index->select();*/
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
	<div id="sadrzaj1">
		
				<div id="textD"><h2>DOBRODOSLI!</h2>
				
					<p>dadadadad dadadadad dadadadad dadadadad dadadadad  
						dadadadad dadadadad dadadadad dadadadad dadadadad 
						dadadadad dadadadad dadadadad dadadadad dadadadad 
						dadadadad dadadadad dadadadad dadadadad dadadadad</p>
					 <p>dadadadad dadadadad dadadadad dadadadad dadadadad
					 dadadadad dadadadad dadadadad dadadadad dadadadad 
					 dadadadad  dadadadad dadadadad dadadadad </p>
				 	<br>
				 	   <div id="dugme"><a href="#">Vise o tome</a></div> 
				</div>
				<div id="textO">
						<h2>O NAMA</h2>
					<p>dadadadad dadadadad dadadadad dadadadad dadadadad 
					dadadadad dadadadad dadadadad dadadadad dadadadad </p>
					<p>dadadadad dadadadad dadadadad dadadadad dadadadad</p>
					<p>dadadadad dadadadad dadadadad dadadadad dadadadad </p>
					dadadadad dadadadad dadadadad dadadadad dadadadad dadadadad 
					dadadadad dadadadad dadadadad dadadadad dadadadad dadadadad </p>
					 <br>
					 <div id="dugme"><a href="#">Vise o tome</a></div> 
				</div>	
	</div>	
	
		</div>