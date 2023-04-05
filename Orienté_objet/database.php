<?php

// Espace de nom
namespace SYRADEV\Utils\DB;

//inclusion du fichier de configuration
require_once 'credentials.php';

use PDO,PDOException;


// Singleton
class Database {

	private PDO $cnx;
	private static $connect = null;

	private function __construct() {
		global $conf;
		// DSN : Data Source Name
		// 'mysql:host=localhost;dbname=oop'
		try {
			$this->cnx = new PDO(
				'mysql:host=' . $conf['db']['host'] . ';dbname=' . $conf['db']['database'],
				$conf['db']['user'],
				$conf['db']['password'],
				[PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
			);
			$this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		} catch(PDOException $e) {
			$message = 'Une Erreur est survenue ! ' . $e->getMessage() . '<hr>';
			die($message);
		
		}
	}
	
	public static function getInstance() {
		
		if( is_null(self::$connect)) {
			self::$connect = new Database;
		}
		return self::$connect;
	}
	
	
	public function requete($sql) {
			
		try {
			$result = $this->cnx->query($sql, PDO::FETCH_ASSOC)->fetchAll();
		
		} catch(PDOException $e) {
			
			$message = 'Une Erreur est survenue ! ' . $e->getMessage() . '<hr>';
			die($message);
		}
		
		return $result;
	
	}
	
	
}






