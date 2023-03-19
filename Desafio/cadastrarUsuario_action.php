<?php
include('protect.php');

if ($user_role !== "admin") {
    die("Você não possui autorização para acessar esta página, realize o <a href=\"login.php\">login</a>.");
  }
    require 'conexao.php';


    $nome = filter_input(INPUT_POST, 'nome');
    $senha = filter_input(INPUT_POST, 'senha');
    $role = filter_input(INPUT_POST, 'role');
    $ativo = 1;
    
    $checa_valor = isset($_POST['role']) ? 1 : 0;
      if($checa_valor == 0) {
        $role = 'user';
      } else {
        $role = 'admin';
      }

    $sql = $mysqli->prepare("INSERT INTO usuario (nome, senha, ativo, role) VALUES (?, ?, ?, ?)");

    $sql->bind_param("ssis", $nome, $senha, $ativo, $role);
    $sql->execute();

    header("Location:Usuarios.php");
