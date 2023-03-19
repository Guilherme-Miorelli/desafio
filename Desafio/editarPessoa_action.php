<?php
include('protect.php');

require 'conexao.php';

$id_pessoa = filter_input(INPUT_POST, 'id_pessoa');
$nome = filter_input(INPUT_POST, 'nome');
$endereco = filter_input(INPUT_POST, 'endereco');
$numero = filter_input(INPUT_POST, 'numero');
$cep = filter_input(INPUT_POST, 'cep');
$bairro = filter_input(INPUT_POST, 'bairro');
$estado = filter_input(INPUT_POST, 'estado');
$cidade = filter_input(INPUT_POST, 'cidade');
$email = filter_input(INPUT_POST, 'email');
$telefone = filter_input(INPUT_POST, 'telefone');
$celular = filter_input(INPUT_POST, 'celular');
$cpf = filter_input(INPUT_POST, 'cpf');
$foto = filter_input(INPUT_POST, 'foto');
$target_dir = "fotos/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);

if ($id_pessoa) {

    $sql = $mysqli->prepare("UPDATE pessoa SET nome = ?, endereco = ?, numero = ?, cep = ?, bairro = ?, estado = ?, 
    cidade = ?, email = ?, telefone = ?, celular = ?, cpf = ?, foto = ? WHERE id_pessoa = ?");

    $sql->bind_param("ssisssssssssi", $nome, $endereco, $numero, $cep, $bairro, $estado, $cidade, $email, 
    $telefone, $celular, $cpf, $target_file, $id_pessoa);
    $sql->execute();



    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if ($_FILES["foto"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    header("Location: Pessoas.php");
    exit;
} else {
    header("Location: Pessoas.php");
    exit;
}
