<?php
include 'conexao.php';
session_start();

$produtos = $conn->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
    <script src="theme.js" type="text/javascript"></script>
    <style>
        section {
            font-size: 27px;
            line-height: 1.5;
            background-color: #f8f9fa;
            border: gray solid;
            border-radius: 25px;
            padding: 8%;
            margin: 2%;
        }

        @media (prefers-color-scheme: dark) {
            section {
                background-color: #2b3035;
            }
        }
    </style>
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

                    <?php if (isset($_SESSION["nome_usuario"]) || isset($_SESSION["nivel_acesso"])): // Mostra link da página catálogo apenas se o usuário estiver logado ?>
                        <li class="nav-item">
                            <a class="nav-link" href="catalogo.php">Catálogo</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="sobre.php">Sobre</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <?php echo date('d/m/Y H:i', time()); ?>
                </span>
                &nbsp;
                <?php if (isset($_SESSION["nome_usuario"]) || isset($_SESSION["nivel_acesso"])): ?>
                    <ul class='navbar-nav ml-auto'>
                        <li class='nav-item'>
                            <span class='nav-link me-2'>Bem-vindo, <?= $_SESSION['nome_usuario'] ?></span>
                        </li>

                        <?php if ($_SESSION['nivel_acesso'] === 'ADMINISTRADOR'): // Mostra link da Área Administrativa caso usuário seja Admnistrador ?>
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

    <div class="text-center container">
        <h1 class="text-center mt-4">Sobre</h1>
        <br>
        <section>
            <p>Este sistema web de produtos é dedicado à listagem e visualização de mangás, oferecendo uma experiência
                amigável e organizada para os usuários. Em uma página de catálogo, cada mangá listado exibe informações
                essenciais como o nome, descrição e preço. A interface permite que os usuários naveguem facilmente por
                diversas opções, visualizando rapidamente o conteúdo e as características de cada produto. Além disso, o
                sistema permite fazer buscas por título, facilitando a descoberta dos produtos desejados.</p>
        </section>
</body>

</html>