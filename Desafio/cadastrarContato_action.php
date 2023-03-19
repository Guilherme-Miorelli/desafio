<?php
include('protect.php');
require 'conexao.php';


$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$telefone = filter_input(INPUT_POST, 'telefone');
$celular = filter_input(INPUT_POST, 'celular');
$datanasc = filter_input(INPUT_POST, 'datanasc');
$checarfav = filter_input(INPUT_POST, 'favorito');

if ($checarfav != 1){
    $favorito = 0;
} else {
    $favorito = 1;
}

$sql = $mysqli->prepare("INSERT INTO contato (nome, email, telefone, celular, datanasc, favorito) VALUES (?, ?, ?, ?, ?, ?)");

$sql->bind_param("sssssi", $nome, $email, $telefone, $celular, $datanasc, $favorito);
$sql->execute();

header("Location:Contatos.php");
