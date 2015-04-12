<?php
	include "header.php";
?>
<?php
if (isset($_GET['name'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $comment = $_POST['comment'];

  $headers = "From: $email";
  mail("farmashop@gmail.com", "Kontakt sa sajta FarmaShop", "$pitanje");
}

?>
<div class="main_bg">
<div class="wrap">
<div class="wrapper">	
	<div class="main">
		<div id="contact">
		<div class="section_group">				
				<div class="col span_1_of_2">
      			<div class="company_address">
				     	<h2 class="style">Adresa </h2>
						<p>Surcinski put 2b</p>
						<p>Beograd</p>
				   		<p>Phone: +381 (64) 326 49 04</p>
				 	 	<p>Email: <span> farmashop@gmail.com</span></p>
				   		<p>Pratite nas <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
					<div class="contact_info">
			    	 	<h2 class="style">Pronadjite nas</h2>
			    	 		<div class="map">
			    	 			<iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.9650135984066!2d20.25198230000001!3d44.7815186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a699946566ea3%3A0x7c4695292ad43c3e!2zMTUzYSwg0KHRg9GA0YfQuNC9!5e0!3m2!1ssr!2srs!4v1417355766058"  width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"style="border:1"></iframe>
					   			<br><small><a href="https://goo.gl/maps/WB0z8" style="color: #555555;text-align:left;font-size:13px">View Larger Map</a></small>
					   		</div>
      				</div>				   
				   <div class="clear"></div>
				</div>	
				<div class="container">
      <form method="post" action="kontact.php" class="contact-us form-horizontal">
		<legend><h2 class="style">Kontaktirajte nas</h2> </legend>		
		<div class="control-group">
	        <label class="control-label">Ime</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" class="input-xlarge" name="name" placeholder="Ime">
				</div>
			</div>
		</div>
		<div class="control-group">
	        <label class="control-label">Email</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
					<input type="text" class="input-xlarge" name="email" placeholder="Email">
				</div>
			</div>	
		</div>
		<div class="control-group">
	        <label class="control-label">Telefon</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-globe"></i></span>
					<input type="text" id="number" class="input-xlarge" name="number" placeholder="Telefon">
				</div>
			</div>
		</div>
		<div class="control-group">
	        <label class="control-label">Komentar</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-pencil"></i></span>
					<textarea name="comment" class="span4" rows="4" cols="80" placeholder="Komentar (Max 200 karaktera)"></textarea>
				</div>
			</div>
		</div>
		<div class="control-group">
		  <div class="controls">
			<button type="submit" class="btn btn-primary">Posaljite</button>
			<button type="button" class="btn">Cancel</button>
	      </div>	
		</div>
	  </form>

    <div class="modal hide fade">
      <div class="modal-body">
		<p class="ajax_data"></p>
      </div>
    </div>

    </div>
  			<div class="clear"></div>
		  </div>

	</div>
	<div class="clear"></div>
</div>
</div>
</div>
<?php
	include "footer.php";
?>			
				<!--<div class="col span_2_of_4">
				  <div class="contact-form">
				  	<h2 class="style">Kontaktirajte nas</h2>
					       <form method="post" action="kontact.php">
					    	<div>
						    	<span><label>IME</label></span>
						    	<span><input name="name" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input name="email" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>TELEFON</label></span>
						    	<span><input name="telefon" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>PITANJE</label></span>
						    	<span><textarea name="pitanje"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="POSALJITE"></span>
						  </div>
					    </form>

				    </div>
  				</div>		-->
  	 