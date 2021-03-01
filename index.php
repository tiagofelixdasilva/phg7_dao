<?php
require_once 'config.php';

$sql = new Sql();

/*
$usuarios = $sql->select("SELECT * FROM tb_usuarios");


echo json_encode($usuarios);

$root  =  new Usuario();

$root->loadById(3);

echo $root;

$lista =  Usuario::getList(); // acessando funcao estatica


echo json_encode($lista);

//carrega uma lista de usuarios buscanod pelo login

$search = Usuario::search("jo");

echo json_encode($search);

$usuario  = new Usuario();

$usuario->login('dani','44555');

echo $usuario;

$aluno =  new Usuario("dangela","2406");

$aluno->insert();

echo $aluno;
*/
$tiago = new Usuario();

$tiago->loadById(31);

$tiago->update('denilson',4555444);

$tiago->delete();

echo $tiago;