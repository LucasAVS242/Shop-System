<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Sistema Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Painel Administrativo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cadastrar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="cadastrar_produto.php">Produto</a></li>
                        <li><a class="dropdown-item" href="cadastro_usuario.php">Usuário</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Registro
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="lista_produtos.php">Produtos</a></li>
                        <li><a class="dropdown-item" href="lista_usuarios.php">Usuários</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <span class="navbar-text">
                    <?php echo date('d/m/Y H:i', time()); ?>
                </span>
                <li class="nav-item">
                    <span class="nav-link me-2">Bem-vindo, <?php echo $_SESSION['nome_usuario']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-danger" href="logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="styles/main.css">
<script src="theme.js" type="text/javascript"></script>
