<?php
class usuario{
	private $idusuario;
	private $deslogin;
	private $desenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		return $this->idusuario=$value;

	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		return $this->deslogin=$value;

	}
	public function getDesenha(){
		return $this->desenha;
	}
	public function setDesenha($value){
		return $this->desenha=$value;

	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		return $this->dtcadastro=$value;

	}

	public function loadById($id){
		$sql=new sql();
		$result=$sql->select("SELECT * FROM tb_usuario WHERE idusuario=:ID ",array(":ID"=>$id));
		
		if (count($result) >0) {
			$row=$result[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDesenha($row['desenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
			# code...
		}
	}
	public function __toString(){
		return json_encode(array(
         "idusuario"=>$this->getIdusuario(),
         "deslogin"=>$this->getDeslogin(),
         "desenha"=>$this->getDesenha(),
         "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}



?>
