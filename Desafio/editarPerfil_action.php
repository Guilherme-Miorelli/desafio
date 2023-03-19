<?php

include('protect.php');

    require 'conexao.php';

    $id_usuario = filter_input(INPUT_POST, 'id_usuario');
    $nome = filter_input(INPUT_POST, 'nome');
    $senha = filter_input(INPUT_POST, 'senha');
    $ativo = filter_input(INPUT_POST, 'ativo');
    $role = filter_input(INPUT_POST, 'role');

    $checa_valor = isset($_POST['role']) ? 1 : 0;
      if($checa_valor == 0) {
        $role = 'user';
      } else {
        $role = 'admin';
      }

      $checa_valor = isset($_POST['ativo']) ? 1 : 0;
      if($checa_valor == 0) {
        $ativo = 0;
      } else {
        $ativo = 1;
      }

    if($id_usuario ){
        $sql = $mysqli->prepare("UPDATE usuario SET nome = ?, senha = ?, ativo = ?, role = ? WHERE id_usuario = ?");

        $sql->bind_param("ssisi", $nome, $senha, $ativo, $role, $id_usuario);
        $sql->execute();
       
        header("Location: Home.php");
        exit;
    } else {
        header("Location: Home.php");
        exit;
    }

?>