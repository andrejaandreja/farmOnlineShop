<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php include_once("header.php");?>
<?php 
if (isset($_GET['id'])) {

    include "backend/db.php"; 
	$id = $_GET['id']; 
	$sql = mysql_query("SELECT * FROM vrsta where id='$id'");
	$productCount = mysql_num_rows($sql);
    if ($productCount > 0) {

		while($row = mysql_fetch_array($sql)){ 
      $id = $row["id"];
			 $zivotinja = $row["zivotinja"];
			 $vrsta = $row["vrsta"];
       $detalji = $row["detalji"];
			 $cena = $row["cena"];
         }
		 
	} else {
		echo "Taj model ne postoji";
	    exit();
	}
		
} else {
	echo "Nesto nedostaje.";
	exit();
}
mysql_close();
?>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<div id="sadrzaj-back">
<div align="center">
  <div id="pageContent">
  <table style="margin-top: 250px;margin-left: 400px; line-height:1.5;" width="150%" cellspacing="0" cellpadding="15">
  <tr>
    <td width="19%" valign="top"><img src='vrste/' .$id .'.jpg' width="200" height="250" alt="<?php echo $id; ?>" /><br />
    <td width="81%" valign="top"><div style="color: #f59812; font-size: 2em; font-weight:800;"><?php echo "Vrsta:  ". "</div>".$vrsta; ?>
      <div style="color: #f59812; font-size: 2em; font-weight:800;"><?php echo "Cena:  ". "</div>".$cena ." din"?>
      <div style="color: #f59812; font-size: 2em; font-weight:800;"><?php echo "Detalji:  ". "</div>".$detalji; ?><br></br>
            <form id="form1" name="form1" method="post" action="#.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="Dodajte u korpu" />
      </form>
      </td>
    </tr>
</table>
  </div>
</div>
</div>
<?php include_once("footer.php");?>
</body>
</html>