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

	public static function selectAll($table, $option = "1", $all = true, $comportement = PDO::FETCH_CLASS){
		self::createConnexion();
		$sql = "SELECT * FROM `$table` WHERE $option";
		//$sql = 'SELECT * FROM `'.$table.'` WHERE '.$option;
		//var_dump($sql);
		$req = self::$_conn->query($sql);
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, ucfirst($table));
		}
		if($all){
			return $req->fetchAll($comportement);
		} else {
			return $req->fetch($comportement);
		}	
	}

	public static function selectByJoin($table2, $join = "liste", $option = 1, $comportement = PDO::FETCH_CLASS ){
		self::createConnexion();

		$sql = "SELECT * FROM `$join` j JOIN `$table2` t2 ON (`j`.`id_$table2` = `t2`.`id_$table2`) WHERE $option ";
		$req = self::$_conn->query($sql);
		//var_dump($sql);
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, ucfirst($table2));
		}
		return $req->fetchAll($comportement);
	}

	public static function insert($table, $data){
		self::createConnexion();

		$sql = "INSERT INTO `$table`([CHAMPS]) VALUES ([VALUES]);";
		$champs = [];
		$values = [];
		foreach($data as $key => $value){
			$champs[] = $key;
			$values[] = ":".$key;
		}
		$sql = str_replace('[CHAMPS]', implode(', ', $champs), $sql);
		$sql = str_replace('[VALUES]', implode(', ', $values), $sql);
		$req = self::$_conn->prepare($sql);
		foreach($data as $key => $valueToInsert){
			$req->bindvalue(":".$key, $valueToInsert);
		}

		return $req->execute();
	}

	public static function delete($table, $id){
		self::createConnexion();
		$sql = "DELETE FROM `$table` WHERE `id_$table` = :id";
		$req = self::$_conn->prepare($sql);
		$req->bindvalue(":id", $id, PDO::PARAM_INT);
		return $req->execute();
	}

	public static function update($table, $data){
		self::createConnexion();
		//UPDATE `produit` SET `nom` = 'test2', `prix_unit` = '22.00' WHERE `produit`.`id_produit` = 17 
		$sql = "UPDATE `$table` SET [SET] WHERE `$table`.`id_$table` = :id_table";
		$set = [];
		$id = null;
		foreach($data as $key => $value){
			if(substr($key, 0,2) != "id"){
				$set[] = $key . " = :".$key;
			} else {
				$id = $value;
			}
		}
		$sql = str_replace('[SET]', implode(', ', $set), $sql);
		var_dump($sql);
		$req = self::$_conn->prepare($sql);
		foreach($data as $key => $valueToInsert){
			if(substr($key, 0,2) != "id"){
				$req->bindvalue(":".$key, $valueToInsert);
			}
		}
		$req->bindvalue(":id_table", $id, PDO::PARAM_INT);
		return $req->execute();
		//var_dump($req->debugDumpParams());
	}
}