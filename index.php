<?php
session_start();

ini_set('display_errors', true); 
  
define('__ROOT__', dirname(dirname(__FILE__))); 
  
/* Make this file and place in it <?php define("DB_USER", "your_username_here"); define("DB_PASS", "your_password_here") ?> */
require_once("../Config/Database.php");

require_once('Drivers/Database.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
	$controller = $_GET['controller'];
	$action = $_GET['action'];
} 
else 
{
	$controller = 'Pages';
	$action     = 'home';
}

require_once('Views/layout.php');
?>