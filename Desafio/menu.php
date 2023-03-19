<div id="menu">
  <nav class="navbar bg-light fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-brand dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i>
          <?php echo $_SESSION['nome']; ?>
        </button>
        <ul class="dropdown-menu" id="dropdown_ajuste">
          <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
          <li><a class="dropdown-item" href="logout.php">Sair</a></li>
        </ul>
      </div>
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu de acessos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perfil.php">Meu cadastro</a>
            </li>
            <?php if ($user_role === "admin") : ?>
              <li class="nav-item">
                <a class="nav-link" href="Usuarios.php">Usuários</a>
              </li>
            <?php endif ?>

            <li class="nav-item">
              <a class="nav-link" href="Pessoas.php">Pessoas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contatos.php">Contatos</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</div>