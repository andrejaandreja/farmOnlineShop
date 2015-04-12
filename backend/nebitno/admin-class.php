<?php
include"db.php";

class itg_admin{
 
public function __construct() {
    session_start();
 
    //store the absolute script directory
    //note that this is not the admin directory
 
    //initialize the post variable
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $this->post = $_POST;
        if(get_magic_quotes_gpc ()) {
            //get rid of magic quotes and slashes if present
            array_walk_recursive($this->post, array($this, 'stripslash_gpc'));
        }
    }
 
    //initialize the get variable
    $this->get = $_GET;
    //decode the url
}

private function _check_db($username, $password) {
    global $db;
    $user_row = mysql_num_rows("SELECT * FROM `admin` WHERE `username`='" . mysql_escape_string($username) . "'");
 
    //general return
    if(is_object($user_row) && md5($user_row->password) == $password)
        return true;
    else
        return false;
}
public function _login_action() {
 
    //insufficient data provided
    if(!isset($this->post['username']) || $this->post['username'] == '' || !isset($this->post['password']) || $this->post['password'] == '') {
        header ("location: login.php");
    }
 
    //get the username and password
    $username = $this->post['username'];
    $password = md5(sha1($this->post['password']));
 
    //check the database for username
    if($this->_check_db($username, $password)) {
        //ready to login
        $_SESSION['admin_login'] = $username;
 
        //check to see if remember, ie if cookie
        if(isset($this->post['remember'])) {
            //set the cookies for 1 day, ie, 1*24*60*60 secs
            //change it to something like 30*24*60*60 to remember user for 30 days
            setcookie('username', $username, time() + 1*24*60*60);
            setcookie('password', $password, time() + 1*24*60*60);
        } else {
            //destroy any previously set cookie
            setcookie('username', '', time() - 1*24*60*60);
            setcookie('password', '', time() - 1*24*60*60);
        }
 
        header("location: index.php");
    }
    else {
        header ("location: login.php");
    }
 
    die();
}
public function _authenticate() {
    //first check whether session is set or not
    if(!isset($_SESSION['admin_login'])) {
        //check the cookie
        if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            //cookie found, is it really someone from the
            if($this->_check_db($_COOKIE['username'], $_COOKIE['password'])) {
                $_SESSION['admin_login'] = $_COOKIE['username'];
                header("location: index.php");
                die();
            }
            else {
                header("location: login.php");
                die();
            }
        }
        else {
            header("location: login.php");
            die();
        }
    }
}

}
?>