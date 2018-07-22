<?php 

class Usuario extends Sql {

	private $idUsuario;
	private $desLogin;
	private $desSenha;
	private $dtCadastro;


	public function getIdusuario(){
		return $this->idUsuario;
	}

	public function setIdusuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getDeslogin(){
		return $this->desLogin;
	}

	public function setDeslogin($desLogin){
		$this->desLogin = $desLogin;
	}

	public function getDessenha(){
		return $this->desSenha;
	}

	public function setDessenha($desSenha){
		$this->desSenha = $desSenha;
	}

	public function getDtcadastro(){
		return $this->dtCadastro;
	}

	public function setDtcadastri($dtCadastro){
		$this->dtCadastro = $dtCadastro;
	}



	public function loadById($id){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($resultado) > 0){
			$row = $resultado[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastri(new DateTime($row['dtcadastro']));
		}
	}

	public function __toString(){

		return json_encode(array(
			"idusuario" => $this->getIdusuario(),
			"deslogin" => $this->getDeslogin(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}

 ?>