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
			$this->setData($result[0]);
			
	}
	}

	public static function  getList(){
		$sql=new sql();
		return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin;");
	}
	public static function serch($login){
		$sql=new sql();
		return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			'SEARCH'=>"%".$login."%"
            
		));

	}

	public  function login($login,$password){
		$sql=new sql();
		$result=$sql->select("SELECT * FROM tb_usuario WHERE deslogin=:LOGIN AND desenha=:PASSWORD ",array(":LOGIN"=>$login, ":PASSWORD"=>$password));
		
		if (count($result) >0) {
			$this->setData($result[0]);
			}else{
				throw new Exception("Login e/ou senha invalidos");
	}

	}
	public function setData($data){
	 	    $this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDesenha($data['desenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}
	public function insert(){
	 	$sql=new sql();
	 	$result=$sql->select("CALL sp_usuario_insert(:LOGIN,:PASSWORD)",array(
	 		':LOGIN'=>$this->getDeslogin(),
	 		':PASSWORD'=>$this->getDesenha()
	 	));
	 	if (count($result)>0) {
	 		$this->setData($result[0]);
	 		
	}
	}
	public function update($login,$password){
		$this->setDeslogin($login);
		$this->setDesenha($password);
	   $sql=new sql();
	   $sql->query("UPDATE tb_usuario SET deslogin=:LOGIN,desenha=:PASSWORD WHERE idusuario=:ID ",array(
	   	':LOGIN'=>$this->getDeslogin(),
	 	':PASSWORD'=>$this->getDesenha(),
	 	':ID'=>$this->getIdusuario()

	   ));	

	}
	public function delete(){
	   $sql=new sql();
	   $sql->query("DELETE FROM tb_usuario WHERE idusuario=:ID ",array(
	   	':ID'=>$this->getIdusuario()
	   ));
	   $this->setIdusuario(0);
	   $this->setDeslogin("");
	   $this->setDesenha("");
	   $this->setDtcadastro(new DateTime());
	}

	public function __construct($login="",$password=""){
	   	$this->setDeslogin($login);
	   	$this->setDesenha($password);
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