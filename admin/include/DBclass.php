<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'syntax_note');
define('DB_PASSWORD', 'syntax_note');
define('DB_DATABASE', 'syntax@123');


class DB_con {
	public $connection;
	function __construct(){
		$this->connection = mysqli_connect("localhost","syntax_note","syntax@123","syntax_note");
		//print_r($this->connection) ;
		
		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);
		
	}
	function ret_obj(){
		return $this->connection;
	}
}
global $link,$adminlink,$base_url,$currency;
$link = "https://www.syntaxnote.com/";
$base_url = "https://www.syntaxnote.com/";
$adminlink = "https://www.syntaxnote.com/admin/";
$currency = 'Rs. ' ;
$cookie_name = 'Syntax';
$cookie_time = (3600 * 24 * 30); /*  30 days */
set_time_limit(0);
?>