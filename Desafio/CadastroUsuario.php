<?php
include('protect.php');

if ($user_role !== "admin") {
    die("Você não possui autorização para acessar esta página, realize o <a href=\"login.php\">login</a>.");
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

    <title>Cadastro Usuário</title>

    <link rel="stylesheet" href="http://localhost/Desafio/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/Desafio/css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="http://localhost/Desafio/css/starter-template.css" rel="stylesheet">

</head>

<body>

    <?php require_once 'menu.php'; ?>

    <div class="row" id="content">
        <div class="mx-auto col-10 col-md-8 col-lg-6">
            <form METHOD="POST" id="form_cadastrar" action="cadastrarUsuario_action.php">
                <div class="container row">
                    <input type="hidden" name="id_usuario">
                    <div>
                        <label for="nome">Nome:</label>
                        <input type="text" maxlength=45 class="form-control" name="nome" id="nome" placeholder="Nome" required>
                    </div>
                    <div>
                        <label for="senha">Senha:</label>
                        <input type="password" maxlength=50 class="form-control" name="senha" id="senha" placeholder="Senha" required>
                        <div class="informa">
                            <span>Use oito ou mais caracteres com uma combinação de letras,números ou símbolos</span>
                        </div>
                    </div>
                    <div>
                        <label for="confirmar_senha">Confirme a senha</label>
                        <input type="password" maxlength=50 class="form-control" name="confirmar_senha" id="confirmar_senha" placeholder="Confirmar senha" required>
                    </div>
                </div>
                <div class="checkbox col-md-6 mb-3 container row">
                    <label>
                        <input type="checkbox" name="role" id="role" value = 1> Administrador
                    </label>
                </div>
                <button class="btn btn-primary" type="submit" value="Salvar">Enviar</button>
                <a href="/Desafio/Usuarios.php" type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar o cadastro?'); "><i class="fa fa-close" href="http://localhost/Desafio/Usuarios.php"></i>Cancelar</a>
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

            $('#form_cadastrar').submit(function() {
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