<?php

include('protect.php');
require_once 'conexao.php';

ini_set('error_reporting', E_ERROR);
register_shutdown_function("fatal_handler");
function fatal_handler()
{
    $error = error_get_last();
    echo ("<pre>");
    print_r($error);
}


if (!isset($_GET['buscar'])) {
    header("Location: Pessoas.php");
    exit;
}

$nome = "%" . trim($_GET['buscar']) . "%";

$sql_code = $mysqli->prepare("SELECT * FROM pessoa WHERE nome LIKE ?");
$sql_code->bind_param("s", $nome);
$sql_code->execute();


$dados = $sql_code->get_result();

$resultado = $dados->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Pessoas</title>

    <link rel="stylesheet" href="http://localhost/Desafio/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/Desafio/css/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="http://localhost/Desafio/css/starter-template.css" rel="stylesheet">

</head>

<body>

    <?php
    require_once('menu.php')
    ?>

    <div id="content">
        <form class="form-inline" id="margembusca" action="buscarPessoa.php" method="GET">
            <div class="container-fluid">
                <div class="row" id="menuBusca">
                    <div class="col col-md-4" style="margin-bottom: 5px;">
                        <input type="text" id="buscar" name="buscar" class="form-control " value="<?php if (isset($_GET['buscar'])) {
                                                                                                        echo $_GET['buscar'];
                                                                                                    } ?>" placeholder="Informe o nome" size="50px">
                    </div>
                    <div class="col col-md-2">
                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> Filtrar</button>

                    </div>
                    <div class="col offset-md-4 col-md-2" style="padding-left: 25px;">
                        <a type="button" class="btn btn-success" href="http://localhost/Desafio/CadastroPessoa.php"><i class="fa fa-plus"></i> Incluir novo cadastro</a>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($resultado)) {
                    foreach ($resultado as $pessoas) {
                ?>
                        <tr>
                            <td style="text-align:center"><?php if (!empty($pessoas['foto'])) { ?>
                                    <img src=" <?= $pessoas['foto']; ?>" style="width:50px; height:50px ">
                                <?php } ?>
                            </td>
                            <td><?= $pessoas['nome']; ?></td>
                            <td><?= $pessoas['celular']; ?></td>
                            <td><?= $pessoas['telefone']; ?></td>
                            <td><?= $pessoas['email']; ?></td>
                            <td>
                                <a href="editarPessoa.php?id_pessoa=<?= $pessoas['id_pessoa']; ?>" class="edit" title="Editar" data-toggle="tooltip" data-placement="top"><i class="material-icons">&#xE254;</i></a>
                                <a href="excluirPessoa.php?id_pessoa=<?= $pessoas['id_pessoa']; ?>" class="delete" onclick="return confirm('Tem certeza que deseja excluir a Pessoa?'); " title="Excluir" data-toggle="tooltip" data-placement="top"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?><tr>
                        <td>Não foram encontrados resultados</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://localhost/Desafio/js/jquery.mask.js"></script>
    <!--<script>
        window.jQuery || document.write('<script src="http://localhost/Desafio/bootstrap/js/vendor/jquery.min.js"><\/script>')
    </script>-->
    <script src="http://localhost/Desafio/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>