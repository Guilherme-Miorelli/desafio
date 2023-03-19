<?php
include('conexao.php');

function lembrar_me (string $nome, string $lembrar){
    if ($lembrar == 1){
        $cookie_name = "login_name";
        $cookie_value = $nome;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    }
}

if (isset($_POST['nome']) && isset($_POST['senha'])) {
    
    if(isset($_POST['lembrar'])){  
        lembrar_me($_POST['nome'], $_POST['lembrar']);
    }

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM usuario WHERE nome = '$nome' AND senha = '$senha'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: Acessos.php");
    } else {
        $_SESSION['nao_autenticado'] = true;
        $erro_login = "Credenciais incorretas!";
        echo '<div class="offset-md-4 col-md-4 alerta alerta-perigo">' . $erro_login . '</div>';
        unset($_SESSION['nao_autenticado']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login</title>

    <link rel="stylesheet" href="http://localhost/Desafio/bootstrap/css/bootstrap.min.css">
    <link href="http://localhost/Desafio/css/signin.css" rel="stylesheet">
    <link href="http://localhost/Desafio/css/estilo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">

        <form class="form-signin" method="POST">
            <h2 class="form-signin-heading">Insira usuário e senha :</h2>
            <label for="nome" class="sr-only">Nome usuário</label>
            <input type="text" name="nome" id="nome" value="<?php if(isset($_COOKIE['login_name'])) echo $_COOKIE['login_name'] ?>" class="form-control" placeholder="Nome usuário" required autofocus>
            <label for="senha" class="sr-only">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="lembrar" value="1" id="lembrar"> Lembrar-me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" value="logar" type="submit">Entrar</button>
        </form>

    </div>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>