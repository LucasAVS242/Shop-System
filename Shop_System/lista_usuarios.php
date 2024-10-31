<?php
include 'conexao.php';
include 'controle_acesso.php';
include 'menu.php';

$usuarios = $conn->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);

// Funcionamento da caixa de pesquisa
if (isset($_GET['pesquisar'])) {
    $filtervalues = $_GET['pesquisar'];
    $usuarios = $conn->query("SELECT * FROM usuarios WHERE CONCAT(nome, email, nivel_acesso) LIKE '%$filtervalues%' ")->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        tr {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Lista de Usuários</h1><br>

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
                    <th>Email</th>
                    <th>Nível de Acesso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= htmlspecialchars($usuario['nivel_acesso']) ?></td>
                        <td>
                            <?php if ($usuario['id'] == 1): ?>
                                <span class="text-muted">Sem permissão</span>
                            <?php else: ?>
                                <?php if ($_SESSION['nivel_acesso'] === 'ADMINISTRADOR'): ?>
                                    <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-warning">Editar</a>
                                    <a href="excluir_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-danger" onclick="return confirm('A exclusão é permanente! Tem certeza disso?')">Excluir</a>
                                <?php else: ?>
                                    <span class="text-muted">Sem permissão</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="cadastro_usuario.php" class="btn btn-success mb-3">Cadastrar Usuário</a>
    </div>
</body>

</html>