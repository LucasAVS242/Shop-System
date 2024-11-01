<?php

include 'conexao.php';

session_start();

if (!isset($_SESSION["nome_usuario"]) || !isset($_SESSION["nivel_acesso"])) {
    header("Location: index.php");
    exit;
}

$produtos = $conn->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);

// Funcionamento da caixa de pesquisa
if (isset($_GET['pesquisar'])) {
    $filtervalues = $_GET['pesquisar'];
    $produtos = $conn->query("SELECT * FROM produtos WHERE CONCAT(nome, descricao, preco) LIKE '%$filtervalues%' ")->fetchAll(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
    <style>
        img {
            height: 150px;
            width: 100px;
        }
    </style>
    <script>
        function updateTheme() {
            const colorMode = window.matchMedia("(prefers-color-scheme: dark)").matches ?
                "dark" :
                "light";
            document.querySelector("html").setAttribute("data-bs-theme", colorMode);
        }

        updateTheme()

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', updateTheme)
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Sistema Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <!-- Mostra link da página catálogo apenas se o usuário estiver logado -->
                    <?php if (isset($_SESSION["nome_usuario"]) || isset($_SESSION["nivel_acesso"])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="catalogo.php">Catálogo</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <?php echo date('d/m/Y H:i:s', time()); ?>
                </span>
                &nbsp;
                <?php if (isset($_SESSION["nome_usuario"]) || isset($_SESSION["nivel_acesso"])): ?>
                    <ul class='navbar-nav ml-auto'>
                        <li class='nav-item'>
                            <span class='nav-link me-2'>Bem-vindo, <?= $_SESSION['nome_usuario'] ?></span>
                        </li>

                        <!-- Mostra link da Área Administrativa caso usuário seja Admnistrador -->
                        <?php if ($_SESSION['nivel_acesso'] === 'ADMINISTRADOR'): ?>

                            <li class='nav-item'>
                                <a class='nav-link btn btn-outline' href='admin_dashboard.php'>Área Administrativa</a>
                            </li>

                        <?php endif; ?>
                        <li class='nav-item'>
                            <a class='nav-link btn btn-outline-danger' href='logout.php'>Sair</a>
                        </li>
                    </ul>
                <?php else: ?>
                    <form class='d-flex'>
                        <button class='btn btn-primary me-2' type='submit'><a class='nav-link' href='cadastro.php'>Cadastrar</a></button>
                        <button class='btn btn-outline-primary'><a class='nav-link' href='login.php'>Login</a></button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mt-4">Catálogo de Produtos</h1><br>

        <!-- Caixa de pesquisa -->
        <form style="all: unset;" action="" method="get">
            <div class="input-group mb-3">
                <input type="search" name="pesquisar" value="<?php if (isset($_GET['pesquisar'])) echo $_GET['pesquisar']; ?>" class="form-control" placeholder="Pesquisar">
                <button type="submit" class="btn btn-success">Pesquisar</button>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sinopse</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td><?= htmlspecialchars($produto['descricao']) ?></td>
                        <td><?= htmlspecialchars($produto['preco']) ?></td>
                        <td><img src="images/<?= htmlspecialchars($produto['imagem']) ?>"></img></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>