<?php 

class Sql extends PDO {

	private $conn;


	public function __construct(){

		$this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");
	}

	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statment, $key, $value);
		}

	}

	private function setParam($statment, $key, $value){

		$statment->bindParam($key, $value);
	}

	public function query($querySql, $params = array()){

		$stmt = $this->conn->prepare($querySql);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	public function select($querySql, $params = array()):array{

		$stmt = $this->query($querySql, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}



}

 ?>