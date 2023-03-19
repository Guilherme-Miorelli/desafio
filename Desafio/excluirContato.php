<?php

    include('protect.php');
    require 'conexao.php';

    $id_contato = filter_input(INPUT_GET, 'id_contato');

    if($id_contato){
        $sql = $mysqli->prepare("DELETE FROM contato WHERE id_contato = ?");
        $sql->bind_param("i", $id_contato);
        $sql->execute();
    }

    header("Location: Contatos.php");

?>