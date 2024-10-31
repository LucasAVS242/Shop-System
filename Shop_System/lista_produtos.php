<?php

include 'conexao.php';
include 'controle_acesso.php';
include 'menu.php';

$produtos = $conn->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);

// Funcionamento da caixa de pesquisa
if (isset($_GET['pesquisar'])) {
    $filtervalues = $_GET['pesquisar'];
    $produtos = $conn->query("SELECT * FROM produtos WHERE CONCAT(nome, descricao, quantidade, preco) LIKE '%$filtervalues%' ")->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        img {
            height: 150px;
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Lista de Produtos</h1><br>

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
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td><?= htmlspecialchars($produto['descricao']) ?></td>
                        <td><?= htmlspecialchars($produto['preco']) ?></td>
                        <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                        <td><img src="images/<?= htmlspecialchars($produto['imagem']) ?>"></img></td>
                        <td style="text-align: center;">
                            <?php if ($_SESSION['nivel_acesso'] === 'ADMINISTRADOR'): ?>
                                <a href="editar.php?id=<?= $produto['id'] ?>" style="margin-bottom: 15%;" class="btn btn-warning">Editar</a>
                                <a href="excluir.php?id=<?= $produto['id'] ?>" class="btn btn-danger" onclick="return confirm('A exclusão é permanente! Tem certeza disso?')">Excluir</a>
                            <?php else: ?>
                                <span class="text-muted">Sem permissão</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="cadastrar_produto.php" class="btn btn-success mb-3">Cadastrar Produto</a>
    </div>
</body>
</html>