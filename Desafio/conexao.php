<?php

    $db = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'desafio';

    $mysqli = new mysqli($db, $db_user, $db_password, $db_name);

    if($mysqli->error){
        die("Falha ao conectar ao banco de dados: " . $mysqli->error);
    }    

?>