<?php
	include 'header2.php';
	include 'login.php';
?>
<div id="sadrzaj-back">
	<div id="dodavanje">
		<?php
        class Osoba {
            public $username;
            public $sitename;
            
            public function __construct($username, $sitename) {
              $this->username = $username;
              $this->sitename = $sitename;
            }
            
            public function dobrodosli() {
              return $this->username . ", dobrodosli na sajt " . $this->sitename . ". Uzivajte.";
            }
          }
          
        $osoba = new Osoba('Korisnice', 'FarmaShop');
        
        echo $osoba->dobrodosli(); 
        ?>
        <br></br>
		<b>Dodavanje novog proizvoda:&nbsp;&nbsp;</b><a href="dodavanje_proizvoda.php"><img src="../background/dodavanje.jpg" height="50" width="50"></a><br>
	</div>
	<?php
if(isset($_GET['deleteid'])){
echo 'Da li zelite da obrisete proizvod sa ID '.$_GET['deleteid'].'?<a href="index.php?yesdelete=' .$_GET['deleteid'].' "> Da</a>|
																		   <a href="index.php"> Ne</a>';
	exit();
}
if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM proizvodi WHERE id='$id_to_delete'") or die (myslq_error);
	$pictodelete=("../background/$id_to_delete.jpg");
		if (file_exists($pictodelete)){
			unlink($pictodelete);
		}
		header("location: index.php");
		exit();
}
?>

 <?php
	/*$index = new Database("farma");
	$sql=$index->select();*/
	$sql= mysql_query("SELECT * FROM proizvodi ORDER BY naziv1 DESC"); 
	echo "<Table class='container_121' id='grid_6' align='center' cellspacing='10' cellpadding='10'>";

	$broj = 2;
	while ($row = mysql_fetch_array($sql)) {
			$id=$row["id"];
			$naziv1=$row["naziv1"];
			$naziv2=$row["naziv2"];
		if ($broj%2==0) {
			echo "<tr>";	
		}
	
	echo '<td id="izmeni"><a href="izmena_proizvoda.php?id=' .$id. '"><img src="../background/izmeni.jpg" alt="izmeni" height="50" width="50"></td>
		  <td id="delete"><a href="index.php?deleteid=' .$id .'"><img src="../background/delete.jpg" alt="izmeni" height="50" width="50"></td>
			<Td align="center"><a href="dodavanje_vrsta.php?id=' .$id .'" class="cat">
				<img src="../background/' .$id .'.jpg" height="180" width="400">
				<div class="cat_bot">
					<span>DODAJ: ' .$naziv1.'</span>
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