<?php

    include('protect.php');
    require 'conexao.php';

    $id_pessoa = filter_input(INPUT_GET, 'id_pessoa');

    if($id_pessoa){
        $sql = $mysqli->prepare("DELETE FROM pessoa WHERE id_pessoa = ?");
        $sql->bind_param("i", $id_pessoa);
        $sql->execute();
    }

    header("Location: Pessoas.php");

?>