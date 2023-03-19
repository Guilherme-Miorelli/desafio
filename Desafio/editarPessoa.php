<?php
include('protect.php');

$pessoa = [];
$id_pessoa = filter_input(INPUT_GET, 'id_pessoa');

if ($id_pessoa) {
    $sql = $mysqli->prepare("SELECT * FROM pessoa WHERE id_pessoa = ?");
    $sql->bind_param("i", $id_pessoa);
    $sql->execute();
    $result = $sql->get_result();

    if ($sql->affected_rows > 0) {
        $pessoa = $result->fetch_assoc();
    } else {
        header("Location: Pessoas.php");
        exit;
    }
} else {
    header("Location: Pessoas.php");
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

    <title>Editar Pessoa</title>

    <link rel="stylesheet" href="http://localhost/Desafio/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/Desafio/css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="http://localhost/Desafio/css/starter-template.css" rel="stylesheet">

</head>

<body>

    <?php require_once 'menu.php'; ?>

    <div id="content">

        <form METHOD="POST" id="form_cadastrar" action="editarPessoa_action.php" enctype="multipart/form-data">
            <div class="container row">
            <input type="hidden" name="id_pessoa" value="<?= $pessoa['id_pessoa']; ?>">
                <div class="col-md-6 mb-3">
                    <label for="nome">Nome:</label>
                    <input type="text" maxlength="45" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= $pessoa['nome']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="endereco">Endereco:</label>
                    <input type="text" maxlength="50" class="form-control" name="endereco" id="endereco" placeholder="Endereço" value="<?= $pessoa['endereco']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="numero">Número:</label>
                    <input type="number" maxlength="5" class="form-control" name="numero" id="numero" placeholder="Número" value="<?= $pessoa['numero']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado">Estado:</label>
                    <input type="text" maxlength="2" class="form-control" name="estado" id="estado" placeholder="Estado" value="<?= $pessoa['estado']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                <label for="bairro">Bairro:</label>
                <input type="text" maxlength="50" class="form-control" name="bairro" id="bairro" placeholder="Bairro" value="<?= $pessoa['bairro']; ?>">
            </div>
            <div class="col-md-6 mb-3">
                    <label for="cidade">Cidade:</label>
                    <input type="text" maxlength="45" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="<?= $pessoa['cidade']; ?>">
                </div>
            <div class="col-md-6 mb-3">
                <label for="cep">CEP:</label>
                <input type="text" maxlength="9" class="form-control" name="cep" id="cep" placeholder="CEP" value="<?= $pessoa['cep']; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="cpf">CPF:</label>
                <input type="text" maxlength="14" class="form-control" name="cpf" id="cpf" placeholder="CPF" value="<?= $pessoa['cpf']; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">E-mail:</label>
                <input type="text" maxlength="50" class="form-control" name="email" id="email" placeholder="E-mail" value="<?= $pessoa['email']; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefone">Telefone:</label>
                <input type="tel" maxlength="16" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="<?= $pessoa['telefone']; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="celular">Celular:</label>
                <input type="tel" maxlength="17" class="form-control" name="celular" id="celular" placeholder="Celular" value="<?= $pessoa['celular']; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto">
            </div>
            </div>
            <button class="btn btn-primary" type="submit" value="Salvar">Enviar</button>
            <a href="/Desafio/Pessoas.php" type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar o cadastro?'); "><i class="fa fa-close" href="http://localhost/Desafio/Pessoas.php"></i> Cancelar</a>

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
            $('#cep').mask('00000-000#');
            $('#nome, #cidade, #estado').on("input", function(){
                var regex = /[^a-zA-Zà-úÀ-Ú\s]/g;
                if(this.value.match(regex)){
                    $(this).val(this.value.replace(regex,''));
                }
            });
            $('#form_cadastrar').submit(function(){
                var ragex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/g;
                var email = $('#email').val();
                if(email.match(ragex)){
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