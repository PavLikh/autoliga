<?php

namespace App;

require_once 'db.php';

use PDO;
class QueryBuilder
{

	use \dB;
	
	protected $pdo;

	function __construct()
	{
		// 1. Connect
		
		$this->pdo = new PDO("mysql:host=localhost; dbname=$this->dbname", "$this->dbuser", "$this->dbpass");
	}

}

?>

