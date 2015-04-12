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
	header("location: dodavanje_proizvoda.php"); 
    exit();
}
?>
<?php if (isset($_GET['id'])) {
	$targetID = $_GET['id'];
    $sql = mysql_query("SELECT * FROM proizvodi WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql);
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			 $naziv1 = $row["naziv1"];
			 $naziv2 = $row["naziv2"];
		//	 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
	    echo "Proizvod ne postoji";
		exit();
    }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory List</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="dodavanje_proizvoda.php#formaDodavanja">+ Dodaj novi proizvod</a></div>
<div align="left" style="margin-left:24px;">
      <h2>Inventory list</h2>
      
    </div>
    <hr />
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3>
    &darr; Add New Inventory Item Form &darr;
    </h3>
    <form action="izmena-proizvoda.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Product Name</td>
        <td width="80%"><label>
          <input name="naziv1" type="text" id="naziv1" size="64" value="<?php echo $naziv1; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Product Price</td>
        <td><label>
          $
          <input name="naziv2" type="text" id="naziv2" size="12" value="<?php echo $naziv2; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Slika</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Make Changes" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
  <?php include_once("../footer.php");?>
</div>
</body>
</html>