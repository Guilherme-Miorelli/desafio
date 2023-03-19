<?php

include('protect.php');

    require 'conexao.php';

    $id_contato = filter_input(INPUT_POST, 'id_contato');
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $favorito = filter_input(INPUT_POST, 'favorito');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $celular = filter_input(INPUT_POST, 'celular');
    $datanasc = filter_input(INPUT_POST, 'datanasc');

      $checa_valor = isset($_POST['favorito']) ? 1 : 0;
      if($checa_valor == 0) {
        $favorito = 0;
      } else {
        $favorito = 1;
      }

    if($id_contato ){
        $sql = $mysqli->prepare("UPDATE contato SET nome = ?, email = ?, favorito = ?, telefone = ?, celular = ?, datanasc = ? WHERE id_contato = ?");

        $sql->bind_param("ssisssi", $nome, $email, $favorito, $telefone, $celular, $datanasc, $id_contato);
        $sql->execute();
       
        header("Location: Contatos.php");
        exit;
    } else {
        header("Location: Contatos.php");
        exit;
    }
