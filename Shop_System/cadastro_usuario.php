<?php
include 'conexao.php'; // Conexão com banco de dados
include 'controle_acesso.php';
include 'menu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $nivel_acesso = $_POST['nivel_acesso'];

    $sql = "INSERT INTO usuarios (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nome, $email, $senha, $nivel_acesso]);

    echo "<div class='alert alert-success'>Usuário registrado com sucesso!</div>";
    header('Location: lista_usuarios.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mt-4">Cadastro de Usuário</h2>
                        <form action="cadastro_usuario.php" method="post">
                            <div class="form-group mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" autocomplete="email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nivel_acesso">Nível de Acesso</label><br>
                                <select name="nivel_acesso" id="nivel_acesso" class="form-control form-select">
                                    <option value="ADMINISTRADOR">Administrador</option>
                                    <option value="COMUM" selected>Usuário</option>
                                </select><br>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>