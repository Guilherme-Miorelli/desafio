<?php

    include('protect.php');
    require 'conexao.php';

    $id_usuario = filter_input(INPUT_GET, 'id_usuario');

    if($id_usuario){
        $sql = $mysqli->prepare("DELETE FROM usuario WHERE id_usuario = ?");
        $sql->bind_param("i", $id_usuario);
        $sql->execute();
    }

    header("Location: Usuarios.php");

?>