<?php
include 'conexao.php';
session_start();
$date = date('d/m/Y H:i:s', time());

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
    <style>
        figure {
            margin-left: 1%;
            margin-right: 1%;
        }

        section img {
            margin-top: 5%;
            max-width: 100%;
            height: auto;
            width: 300px;
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
            <!-- <a class="navbar-brand" href="#">System Shop</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <span class="navbar-text">
                        <?php echo $date; ?>
                    </span>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <!-- Mostra link da página catálogo apenas se o usuário estiver logado -->
                    <?php if (isset($_SESSION["nome_usuario"]) || isset($_SESSION["nivel_acesso"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="catalogo.php">Catálogo</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                </ul>
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

    <div class="text-center container">
        <header>
            <h1 class="mt-4" style="text-align: center;">Sistema Shop</h1>
        </header>

        <br>

        <h3>Veja alguns de nossos produtos</h3>
        <div style="display: flex; justify-content: center;">



            <section>
                <?php foreach ($produtos as $produto): ?>
                    <figure class="figure">
                        <a href=""></a><img src="images/<?= htmlspecialchars($produto['imagem']) ?>" class="figure-img img-fluid img-thumbnail" title="<?= htmlspecialchars($produto['nome']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
                        <figcaption class="figure-caption"><?= htmlspecialchars($produto['nome']) ?></figcaption>
                    </figure>
                <?php endforeach; ?>
            </section>
        </div>

        <?php if (!isset($_SESSION["nome_usuario"]) || !isset($_SESSION["nivel_acesso"])): ?>
            <div class="mt-3">
                <p>Quer ver o catálogo completo? <a href="cadastro.php">Cadastre-se aqui</a></p>
                <p>Já possui uma conta? <a href="login.php">Entre aqui</a></p>
            </div>
        <?php endif; ?>

</body>

</html>