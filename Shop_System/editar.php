<?php
include 'conexao.php';
include 'controle_acesso.php';
include 'menu.php';

$id = $_GET['id'];
$produto = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
$produto->execute([$id]);
$produto = $produto->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $arquivoNovo = $_FILES['imagem'];

    if ($arquivoNovo['error'] === UPLOAD_ERR_OK) {
        $nomeArquivoNovo = uniqid() . "-" . $arquivoNovo['name'];
        $file_parts = pathinfo($nomeArquivoNovo);
        $extension = $file_parts['extension'];

        // Verifica se o arquvio enviado é um arquivo de imagem válido
        if (in_array($extension, array('jpg', 'png', 'jpeg', 'gif'))) {
            move_uploaded_file($arquivoNovo['tmp_name'], "images/$nomeArquivoNovo");

            // Remove o arquivo antigo
            if (file_exists("images/" . $produto['imagem'])) {
                unlink("images/" . $produto['imagem']);
            }

            $stmt = $conn->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, imagem = ? WHERE id = ?");
            $stmt->execute([$nome, $descricao, $preco, $quantidade, $nomeArquivoNovo, $id]);
            header("Location: lista_produtos.php");
            exit;
        } else {
            echo "<div class='container text-center mt-4 alert alert-danger'>Por favor insira um arquivo válido para a imagem!</div>";
        }
    } else {
        $stmt = $conn->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ? WHERE id = ?");
        $stmt->execute([$nome, $descricao, $preco, $quantidade, $id]);
        header("Location: lista_produtos.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        img {
            height: 200px;
            width: 200px;
            margin-bottom: 2%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Editar Produto</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br>
                    </div>
                    <div class="form-group">
                        <label for="descricao" class="form-label">Sinopse</label>
                        <textarea class="form-control" name="descricao" id="descricao" rows="4" required><?= htmlspecialchars($produto['descricao']) ?></textarea><br>
                    </div>
                    <div class="form-group">
                        <label for="preco" class="form-label">Preco</label>
                        <input type="text" class="form-control" name="preco" id="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required><br>
                    </div>
                    <div class="form-group">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="text" class="form-control" name="quantidade" id="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Imagem atual</label><br>
                        <img src="images/<?= htmlspecialchars($produto['imagem']) ?>" class="img-thumbnail" title="Imagem atual" alt="Imagem atual"><br>
                        <label for="imagem" class="form-label">Nova imagem (deixe em branco se não quiser alterar)</label><br>
                        <input type="file" class="form-control" name="imagem" id="imagem" accept=".jpg, .png, .jpeg, .gif"><br>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>