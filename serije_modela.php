<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php include_once("header.php");?>
<?php 
if (isset($_GET['id'])) {

    include "backend/db.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$sql = mysql_query("SELECT * FROM modeli where id='$id'");
	$productCount = mysql_num_rows($sql);
    if ($productCount > 0) {

		while($row = mysql_fetch_array($sql)){ 
			 $proizvodjac = $row["proizvodjac"];
			 $model = $row["model"];
       $detalji = $row["detalji"];
			 $serija = $row["serija"];
			 $cena = $row["cena"];
       $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $product_name; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>
<div id="sadrzaj2">
<div align="center" id="sadrzaj8">
  <div id="pageContent">
  <table width="150%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="19%" valign="top"><img src="slike_vozila/<?php echo $id; ?>.jpg" width="200" height="250" alt="<?php echo $model; ?>" /><br />
      <a href="slike_vozila/<?php echo $id; ?>.jpg">Puna velicina</a></td><br>
    <td width="81%" valign="top"><h3><?php echo "Model: ".$model . " " . $serija; ?></h3>
      <p><?php echo "<h4>Detalji: </h4>" . $detalji; ?><br />
      <p><?php echo "<h4>Cena:</h4>".$cena . "€"; ?><br /></p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
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