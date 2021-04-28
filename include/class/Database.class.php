<?php 
/**
 * 
 */
class Database
{
	private static $_host = DBHOST;
	private static $_user = DBUSER;
	private static $_mdp = DBMDP;
	private static $_bdd = DBNAME;

	public static $_conn;

	private static function createConnexion(){
		if(empty(self::$_conn)){
			try{
				self::$_conn = new pdo("mysql:host=".self::$_host.";dbname=".self::$_bdd.";charset=UTF8", self::$_user, self::$_mdp);
			} catch (PDOException $e){
				print("ERREUR de connexion à la bdd : ".$e->getMessage());
				exit;
			}
		}
	}

	public static function selectAll($table, $option = "1", $comportement = PDO::FETCH_OBJ){
		self::createConnexion();
		$sql = "SELECT * FROM `$table` WHERE $option";
		//$sql = 'SELECT * FROM `'.$table.'` WHERE '.$option;
		$req = self::$_conn->query($sql);
		return $req->fetchAll($comportement);
	}
}