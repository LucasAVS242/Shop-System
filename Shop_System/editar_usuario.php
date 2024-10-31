<?php
include 'conexao.php';
include 'controle_acesso.php';
include 'menu.php';

$id = $_GET['id'];
$usuario = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$usuario->execute([$id]);
$usuario = $usuario->fetch(PDO::FETCH_ASSOC);

if ($usuario['id'] == 1) {
    header("Location: lista_usuarios.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $nivel_acesso = $_POST['nivel_acesso'];

    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, nivel_acesso = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $senha, $nivel_acesso, $id]);

    header("Location: lista_usuarios.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Editar Usuário</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br>
                            </div>
                            <div class="form-group">
                                <label for="nome" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" required><br>
                            </div>
                            <div class="form-group">
                                <label for="nivel_acesso">Nível de Acesso</label><br>
                                <select name="nivel_acesso" id="nivel_acesso" class="form-control form-select">
                                    <option value="ADMINISTRADOR">Administrador</option>
                                    <option value="COMUM">Usuário</option>
                                </select><br>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>