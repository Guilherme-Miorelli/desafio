<?php
include('protect.php');

require 'conexao.php';



$usuario = [];
$id_usuario = $_SESSION['id_usuario'];

if ($id_usuario) {
    $sql = $mysqli->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
    $sql->bind_param("i", $id_usuario);
    $sql->execute();
    $result = $sql->get_result();

    if ($sql->affected_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "Erro ao carregar dados";
        header("Location: Home.php");
        exit;
    }
} else {
    header("Location: Home.php");
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

    <title>Editar Perfil</title>

    <link rel="stylesheet" href="http://localhost/Desafio/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/Desafio/css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="http://localhost/Desafio/css/starter-template.css" rel="stylesheet">

</head>

<body>

    <?php require_once 'menu.php'; ?>

    <div class="row" id="content">
        <div class="mx-auto col-10 col-md-8 col-lg-6">
            <form METHOD="POST" id="form_editar" action="editarPerfil_action.php">
                <div class="container row">
                    <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario']; ?>">
                    <div>
                        <label for="nome">Nome:</label>
                        <input type="text" maxlength=45 class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= $usuario['nome']; ?>" required>
                    </div>
                    <div>
                        <label for="senha">Senha:</label>
                        <input type="password" maxlength=50 class="form-control" name="senha" id="senha" placeholder="Senha" value="<?= $usuario['senha']; ?>" required>
                        <div class="informa">
                            <span>Use oito ou mais caracteres com uma combinação de letras,números ou símbolos</span>
                        </div>
                    </div>
                    <div>
                        <label for="confirmar_senha">Confirme a senha</label>
                        <input type="password" maxlength=50 class="form-control" name="confirmar_senha" id="confirmar_senha" placeholder="Confirmar senha" required>
                    </div>
                </div>
                <input type="checkbox" name="ativo" value="1" id="ativo" <?= ($usuario['ativo'] == 1) ? "checked" : "" ?> style="opacity:0">
                <div class = "col-md-6 mb-6" style = "margin-top: 12px; margin-left: 12px;">
                    <button class="btn btn-primary" type="submit" value="Salvar">Enviar</button>
                    <a href="/Desafio/Home.php" type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar o cadastro?'); "><i class="fa fa-close" href="http://localhost/Desafio/Usuarios.php"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://localhost/Desafio/js/jquery.mask.js"></script>
    <script>
        window.jQuery || document.write('<script src="bootstrap/js/vendor/jquery.min.js"><\/script>')
        $(document).ready(function() {
            $('#nome').on("input", function() {
                var regex = /[^a-zA-Zà-úÀ-Ú\s]/g;
                if (this.value.match(regex)) {
                    $(this).val(this.value.replace(regex, ''));
                }
            });

            $('#form_editar').submit(function() {
                var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;
                var senha = $('#senha').val();
                var confirmar_senha = $('#confirmar_senha').val();
                if (senha.match(regex) && (confirmar_senha == senha)) {
                    alert("Cadastrado com sucesso!")
                    return true
                } else if (confirmar_senha != senha){
                    alert("Senhas preenchidas não estão iguais");
                    return false
                } else {
                    alert("Senhas não possuem os requisitos");
                    return false
                }
            });
        });
    </script>
  <script src="http://localhost/Desafio/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>