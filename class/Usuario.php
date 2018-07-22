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



	/*Busca no banco um Usuario pelo seu id*/
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


	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios");
	}


	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH", array(
			":SEARCH" => "%" . $login . "%"
		));


	}

	public function login($login, $senha){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
			":LOGIN" => $login,
			":SENHA" => $senha
		));

		if(count($resultado) > 0){

			$this->setData($resultado[0]);

		}else{

			throw new Exception("Login ou Senha inválidos", 1);
			
		}
	}





	/////////////////////// PDO - DAO - INSERT ///////////////////////////////

	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastri(new DateTime($data['dtcadastro']));

	}



	public function insert(){

		$sql = new Sql();

		$resultado = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			":LOGIN" => $this->getDeslogin(),
			":PASSWORD" => $this->getDessenha()
		));

		if(count($resultado) > 0){
			$this->setData($resultado[0]);
		}


	}

	////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////// PDO - DAO - UPDATE ///////////////////////////////////////////



	public function update($login, $password){

		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			":LOGIN" => $this->getDeslogin(),
			":PASSWORD" => $this->getDessenha(),
			":ID" => $this->getIdusuario()
		));


	}

	///////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////// PDO - DAO - DELETE ///////////////////////////////////////////



	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID" => $this->getIdusuario()
		));

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastri(new DateTime());
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