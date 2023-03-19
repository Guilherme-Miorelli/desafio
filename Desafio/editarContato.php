<?php
include('protect.php');

$contato = [];
$id_contato = filter_input(INPUT_GET, 'id_contato');

if ($id_contato) {
    $sql = $mysqli->prepare("SELECT *, date_format(datanasc, '%d/%m/%Y') as data_formatada FROM contato WHERE id_contato = ?");
    $sql->bind_param("i", $id_contato);
    $sql->execute();
    $result = $sql->get_result();

    if ($sql->affected_rows > 0) {
        $contato = $result->fetch_assoc();
    } else {
        header("Location: Contatos.php");
        exit;
    }
} else {
    header("Location: Contatos.php");
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Editar contato</title>

    <link rel="stylesheet" href="http://localhost/Desafio/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/Desafio/css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="http://localhost/Desafio/css/starter-template.css" rel="stylesheet">

</head>

<body>

    <?php require_once 'menu.php'; ?>

    <div id="content">

        <form METHOD="POST" id="form_editar" action="editarContato_action.php">
            <div class="container row">
            <input type="hidden" name="id_contato" value="<?= $contato['id_contato']; ?>">

                <div class="col-md-6 mb-3">
                    <label for="nome">Nome:</label>
                    <input type="text" maxlength="45" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= $contato['nome']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">E-mail:</label>
                    <input type="text" maxlength="50" class="form-control" name="email" id="email" placeholder="E-mail" value="<?= $contato['email']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" maxlength="16" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="<?= $contato['telefone']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="celular">Celular:</label>
                    <input type="tel" maxlength="17" class="form-control" name="celular" id="celular" placeholder="Celular" value="<?= $contato['celular']; ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="datanasc">Data Nasc.</label>
                    <input type="date" class="form-control" maxlength="10" name="datanasc" id="datanasc" value="<?= $contato['datanasc']; ?>" required>
                </div>
                <div class="checkbox col-md-12 mb-3 container row">
                    <label>
                        <input type="checkbox" name="favorito" id="favorito" value="1" <?= ($contato['favorito'] == 1) ? "checked" : "" ?>> Favorito
                    </label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" value="Salvar">Enviar</button>
            <a href="/Desafio/Contatos.php" type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar o cadastro?'); "><i class="fa fa-close" href="http://localhost/Desafio/Contatos.php"></i> Cancelar</a>

        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://localhost/Desafio/js/jquery.mask.js"></script>
    <script>
        window.jQuery || document.write('<script src="bootstrap/js/vendor/jquery.min.js"><\/script>')
        $(document).ready(function() {
            $('#telefone').mask('(00) 0000-0000#');
            $('#celular').mask('(00) 00000-0000#');
            $('#cpf').mask('000.000.000-00#');
            $('#nome').on("input", function() {
                var regex = /[^a-zA-Zà-úÀ-Ú\s]/g;
                if (this.value.match(regex)) {
                    $(this).val(this.value.replace(regex, ''));
                }
            });
            $('#form_editar').submit(function() {
                var ragex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/g;
                var email = $('#email').val();
                if (email.match(ragex)) {
                    return true;
                } else {
                    alert("Email inválido!");
                    return false;
                }
            });
        });
    </script>
    <script src="http://localhost/Desafio/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>