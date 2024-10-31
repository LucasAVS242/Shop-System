<?php
require_once 'conexao.php';
include 'controle_acesso.php';
include 'menu.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle - Administrador</title>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Painel de Controle - Administrador</h2>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-2">
                <a href="cadastrar_produto.php" class="btn btn-primary btn-lg btn-block">Cadastrar Produto</a>
            </div>
            <div class="col-md-2">
                <a href="lista_produtos.php" class="btn btn-primary btn-lg btn-block">Lista de Produtos</a>
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-2">
                <a href="cadastro_usuario.php" class="btn btn-primary btn-lg btn-block">Cadastrar Usuário</a>
            </div>
            <div class="col-md-2">
                <a href="lista_usuarios.php" class="btn btn-primary btn-lg btn-block">Lista de Usuários&nbsp;</a>
            </div>
        </div>
    </div>

</body>

</html>