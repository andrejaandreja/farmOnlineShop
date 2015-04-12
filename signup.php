
<?php
session_start();

if(isset($_SESSION["username"])){
	header("location: message.php?msg=NO to that weenis");
    exit();
}
?>
<?php
if(isset($_POST["usernamecheck"])){
	include_once("signup/db_conx.php");
$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">Username mora imati izmedju 3 - 16 karaktera</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Username mora poceti slovima!</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong style="color:#009900;">Username ' . $username . ' je slobodan.</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">Username ' . $username . ' je zauzet.</strong>';
	    exit();
    }
}
?>
<?php
if(isset($_POST["emailcheck"])){
	include_once("signup/db_conx.php");
    $email = $_POST['emailcheck'];
	$sql = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
    $email_check = mysqli_num_rows($query);
    if (is_numeric($email[0])) {
	    echo '<strong style="color:#F00;">Email mora poceti slovima!</strong>';
	    exit();
    }
    if ($email_check < 1) {
	    echo '<strong style="color:#009900;">Email ' . $email . ' je slobodan.</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">Email ' . $email . ' je zauzet.</strong>';
	    exit();
    }
}
?>
<?php

if(isset($_POST["u"])){
	
	include_once("signup/db_conx.php");
	
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
	$e = mysqli_real_escape_string($db_conx, $_POST['e']);
	$p = $_POST['p'];
	$g = preg_replace('#[^a-z]#', '', $_POST['g']);
	$c = preg_replace('#[^a-z ]#i', '', $_POST['c']);
	
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	
	$sql = "SELECT id FROM users WHERE username='$u' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
	$u_check = mysqli_num_rows($query);
	
	$sql = "SELECT id FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
	$e_check = mysqli_num_rows($query);
	
	if($u == "" || $e == "" || $p == "" || $g == ""){
		echo "Nisu sva polja popunjena";
        exit();
	} else if ($u_check > 0){ 
        echo "Username je zauzet. Molimo Vas unesite drugi! ";
        exit();
	} else if ($e_check > 0){ 
        echo "Email adresa je zauzeta. Molimo Vas unesite drugu!";
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username mora biti izmedju 3 i 16 karaktera";
        exit(); 
    } else if (is_numeric($u[0])) {
        echo 'Username ne moze poceti brojevima';
        exit();
    } else {

		$cryptpass = crypt($p);
		include_once ("signup/randStrGen.php");
		$p_hash = randStrGen(20)."$cryptpass".randStrGen(20);
		
		$sql = "INSERT INTO users (username, email, password, pol, drzava, ip, signup, lastlogin, notescheck)       
		        VALUES('$u','$e','$p_hash','$g','$c','$ip',now(),now(),now())";
		$query = mysqli_query($db_conx, $sql); 
		$uid = mysqli_insert_id($db_conx);
		
		/*$sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
		$query = mysqli_query($db_conx, $sql);
		
		if (!file_exists("user/$u")) {
			mkdir("user/$u", 0755);
		}*/
		
	$to = "$e";							 
		$from = "farmashop@mail.com";
		$subject = 'Aktivacija';
		$message = '<html><head><meta charset="UTF-8"><title>Aktivaciona poruka</title></head><body style="margin:0px; 
		font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.farmashop.com">
		<img src="http://www.farmashop.com/background/farma1.jpg" width="36" height="30" alt="farmashop" style="border:none; float:left;"></a>Aktivacija naloga</div>
		<div style="padding:24px; font-size:17px;">Dobrodosli! '.$u.',<br /><br />Kliknite na link kako bi aktvirali vas nalog:<br /><br />
		<a href="http://www.farmashop.com/activation.php?id='.$uid.'&u='.$u.'&e='.$e.'&p='.$p_hash.'">Kliknite ovde za aktivaciju:</a><br /><br />
		Uspesno logovanje nakon aktiviranja vaze:<br />* E-mail adresa: <b>'.$e.'</b></div></body></html>';
		$headers = "From: $from\n";
		if(mail($to, $subject, $message, $headers)){
			echo "Uspesno poslat mail.";
		}else{
			echo "Mail nije poslat!";
		}
		echo "Uspesno ste se registrovali!";
		exit();
	}
	exit();
}
?>
<script>
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}
function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'provera ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}
function checkemail(){
	var e = _("email").value;
	if(e != ""){
		_("emailstatus").innerHTML = 'provera ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("emailstatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("emailcheck="+e);
	}
}
function signup(){
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var c = _("drzava").value;
	var g = _("pol").value;
	var status = _("status");
	if(u == "" || e == "" || p1 == "" || p2 == "" || c == "" || g == ""){
		status.innerHTML = "Popunite sva polja!";
	} else if(p1 != p2){
		status.innerHTML = "Vas password se ne poklapa!";
	} else if( _("terms").style.display == "none"){
		status.innerHTML = "Molimo Vas procitajte uputstvo!";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'molimo sacekajte ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText != "signup_success"){
					status.innerHTML = ajax.responseText;
					_("signupbtn").style.display = "block";
				} else {
					window.scrollTo(0,0);
						_("signupform").innerHTML = "Uspesno ste se registrovali. "+u+", proverite vas e-mail <u>"+e+"</u> kako bi kompletirali registrovanje.";
				}
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1+"&c="+c+"&g="+g);
	}
}
function openTerms(){
	_("terms").style.display = "block";
	emptyElement("status");
}
/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */
</script>
<?php
	include('header.php');
?>
<div id="sadrzaj-gajenje" >
<div id="signUpforma">
	<h3>Ulogujte se</h3>
  <form name="signupform" id="signupform" onsubmit="return false;" style="margin-top:200px; margin-left: 200px;">
    <div>Username: </div>
    <input id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16">
    <span id="unamestatus"></span>
    <div>E-mail adresa:</div>
    <input id="email" type="text" onblur="checkemail()" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="88">
    <span id="emailstatus"></span>
    <div>Sifra:</div>
    <input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="16">
    <div>Potvrdite sifru:</div>
    <input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="16">
    <div>Pol:</div>
    <select id="pol" onfocus="emptyElement('status')">
      <option value=""></option>
      <option value="m">Musko</option>
      <option value="f">Zensko</option>
    </select>
    <div>Drzava:</div>
    <select id="drzava" onfocus="emptyElement('status')">
      <option value="1">Srbija</option>
    </select>
    <div>
      <a href="#" onclick="return false" onmousedown="openTerms()">
        Pravila sajta
      </a>
    </div>
    <div id="terms" style="display:none;">
      <h3>Pravila sajta</h3>
      </div>
    <br /><br />
    <button id="signupbtn" onclick="signup()">Napravite nalog</button>
    <span id="status"></span>
  </form>
</div>

<?php
	include('footer.php');
?>	