<?php
$dbuser = 'farma';
$dbname = 'farma';
$dbpassword = 'farmafarma';
$dbhost = 'localhost';
 
/** Stop editing from here, else you know what you are doing <img src="http://www.intechgrity.com/wp-includes/images/smilies/icon_wink.gif?84cd58" alt=";)" class="wp-smiley">  */
 
/** defined the root for the db */
if(!defined('ADMIN_DB_DIR'))
define('ADMIN_DB_DIR', dirname(__FILE__));
 
global $db;
$db = new mysqli($dbuser, $dbpassword, $dbname, $dbhost);
?>