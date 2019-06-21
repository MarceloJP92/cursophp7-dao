<?php
class sql extends PDO{

	private $conn;
	public function __construct(){
     $this->conn = new PDO("mysql:hots=localhost;dbname=dbphp7","root","");
	}
	public function setParams($statment,$paramentrs=array()){
		foreach ($paramentrs as $key => $value) {
      $this->setParam($statment, $key,$value);
	 	
	 	}

	}
	private function setParam($statment,$key,$value){
		$statment->bindParam($key,$value);
	}
	public function query($rowQuery,$params=array()){
	 $stmt=$this->conn->prepare($rowQuery);
	 $this->setParams($stmt,$params);
	 $stmt->execute();

	 return $stmt;
	 }
	 public function select($rowQuery,$params=array()):array{
	 	$stmt=$this->query($rowQuery,$params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

	 }

	}

?>