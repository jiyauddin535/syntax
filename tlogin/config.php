<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();

define('PROJECT_NAME', 'Login System with Twitter using OAuth PHP and Mysql - www.thesoftwareguy.in');

define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'shr_superhuman');
define('DB_SERVER_PASSWORD', 'Shr#@mysql@321');
define('DB_DATABASE', 'shr_superhuman');


$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}


define("CLIENT_ID", "your client ID");
define("SECRET_KEY", "your secret key");
/* make sure the url end with a trailing slash, give your site URL */
define("SITE_URL", "http://demos.thesoftwareguy.in/login-with-twitter/");
/* the page where you will be redirected for authorization */
define("REDIRECT_URL", SITE_URL."twitter_login.php");

define("LOGOUT_URL", SITE_URL."logout.php");
?>