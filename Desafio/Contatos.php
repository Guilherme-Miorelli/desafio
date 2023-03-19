<?php
include('protect.php');
require_once 'conexao.php';

$lista = [];
$sql_code = "SELECT *, date_format(datanasc, '%d/%m/%Y') as data_formatada FROM contato";
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
$lista = $sql_query->fetch_all(MYSQLI_ASSOC);

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

    <title>Contatos</title>
    <link href="http://localhost/Desafio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/Desafio/css/jumbotron.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="http://localhost/Desafio/css/estilo.css" rel="stylesheet">
    <!-- link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /-->

</head>

<body>
    <?php
    require_once('menu.php');
    ?>
    <div id="content">
        <form class="form-inline" id="margembusca" action="buscarContato.php" method="GET">
            <div class="container-fluid">
                <div class="row" id="menuBusca">
                    <div class="col col-md-4" style="margin-bottom: 5px;">
                        <input type="text" id="buscar" name="buscar" class="form-control " placeholder="Informe o contato" size="50px">
                    </div>
                    <div class="col col-md-2">
                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> Filtrar</button>

                    </div>
                    <div class="col offset-md-4 col-md-2" style="padding-left: 25px;">
                        <a type="button" class="btn btn-success" href="http://localhost/Desafio/CadastroContato.php"><i class="fa fa-plus"></i> Incluir novo contato</a>

                    </div>
                </div>
            </div>
        </form>
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Favorito</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Celular</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Data Nasc.</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $contatos) : ?>
                        <tr>
                            <td style="text-align:center"><?php if ($contatos['favorito']) { ?>
                                    <img src="images/estrela.png">
                                <?php } else { ?>
                                    <img src="images/estrela_apagada.png">
                                <?php } ?>
                            </td>
                            <td><?= $contatos['nome']; ?></td>
                            <td><?= $contatos['celular']; ?></td>
                            <td><?= $contatos['telefone']; ?></td>
                            <td><?= $contatos['email']; ?></td>
                            <td><?= $contatos['data_formatada']; ?></td>
                            <td>
                                <a href="editarContato.php?id_contato=<?= $contatos['id_contato']; ?>" class="edit" title="Editar" data-toggle="tooltip" data-placement="top"><i class="material-icons">&#xE254;</i></a>
                                <a href="excluirContato.php?id_contato=<?= $contatos['id_contato']; ?>" class="delete" onclick="return confirm('Tem certeza que deseja excluir o contato?'); " title="Excluir" data-toggle="tooltip" data-placement="top"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://localhost/Desafio/js/jquery.mask.js"></script>
    <!-- script>
    window.jQuery || document.write('<script src="http://localhost/Desafio/bootstrap/js/vendor/jquery.min.js"><\/script>')
  </script -->
    <script src="http://localhost/Desafio/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>