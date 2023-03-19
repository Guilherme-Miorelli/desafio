<?php
require_once 'conexao.php';

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id_usuario'])){
    die("Você não possui autorização para acessar esta página, realize o <a href=\"login.php\">login</a>.");
}

$id_usuario = $mysqli->real_escape_string($_SESSION['id_usuario']);

$sql_code = "SELECT role, ativo FROM usuario WHERE id_usuario = " . $id_usuario;
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
$usuario = $sql_query->fetch_assoc();
$user_role = $usuario["role"];
$ativo = $usuario["ativo"];

if($ativo == 0){
    die("Seu usuário não encontra-se disponível, entre em contato com o administrador e realize o <a href=\"login.php\">login</a>.");
}
