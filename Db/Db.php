<?php 
namespace App\Db;

//On import PDO
use PDO;
use PDOException;

class Db extends PDO{

	//instance unique de la classe
	private static $instance;

	//Information de connexion a la BD
	 private const DBHOST = "localhost";
	 private const DBUSER = "root";
	 private const DBPASS = "killer@123";
	 private const DBNAME = "archives";


private function __construct(){
	 	//DSN de connexion
	 	$_dsn = 'mysql:dbname='.self::DBNAME.';host='.self::DBHOST;
try{
	//on appele le constructeur PDO
	 	parent::__construct($_dsn, self::DBUSER,self::DBPASS);
	 	//On appelle les setAttribute pour recuperer tous les erreurs
	 	$this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAME utf8');
	 	$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	 	$this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
	die($e->getMessage());
}
	 	
	 	
	 } 

public static function getInstance(): self
{
	if(self::$instance === null){
		self::$instance = new self();
	 }
	 return self::$instance;
	}
}

 ?> 