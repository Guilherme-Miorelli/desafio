<?php
include('protect.php');
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

  <title>Menu de acessos</title>

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
    <div class="jumbotron">
      <div class="container">
        <h1>Bem-vindo(a) <?php echo $_SESSION['nome']; ?> !</h1>
        <p>Para acessar o menu de acessos clique sob o menu localizado no canto superior esquerdo de sua tela.</p>
      </div>
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