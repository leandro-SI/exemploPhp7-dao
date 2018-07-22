<?php 

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/


/*Carrega um Usuario
$usuario = new Usuario();
$usuario->loadById(2);
echo $usuario;*/


//Carrega uma Lista de Usuarios
/*$lista = Usuario::getList();
echo json_encode($lista);*/


/*//Carrega uma lista de usuários buscando pelo login
$search = Usuario::search("L");
echo json_encode($search);*/


/*//Carrega um usuário usando o login e a senha
$usuario = new Usuario();
$usuario->login("Leandro", "1234");
echo $usuario;*/


/*//Criando um novo Úsuário
$aluno = new Usuario();
$aluno->setDeslogin("aluno");
$aluno->setDessenha("@alun0");
$aluno->insert();
echo $aluno;
*/


$usuario = new Usuario();

$usuario->loadById(4);

$usuario->update("professor", "1234");

echo $usuario;

 ?>