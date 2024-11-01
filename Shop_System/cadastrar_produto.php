<?php
include 'conexao.php';
include 'controle_acesso.php';
include 'menu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $arquivo = $_FILES['imagem'];

    if ($arquivo['error'] === UPLOAD_ERR_OK) {

        $nomeArquivo = uniqid() . "-" . $arquivo['name'];
        $file_parts = pathinfo($nomeArquivo);
        $extension = $file_parts['extension'];

        // Verifica se o arquvio enviado é um arquivo de imagem válido
        if (in_array($extension, array('jpg', 'png', 'jpeg', 'gif'))) {
            
            move_uploaded_file($arquivo['tmp_name'], "images/$nomeArquivo");

            $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade, imagem) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $descricao, $preco, $quantidade, $nomeArquivo]);

            header("Location: lista_produtos.php");
            exit;
        } else {
            echo "<div class='container text-center mt-4 alert alert-danger'>Por favor insira um arquivo válido para a imagem!</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Cadastrar Produto</h1><br>
        <div class="card">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nome" class="form-label">Nome do produto</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="descricao" class="form-label">Sinopse</label>
                        <textarea class="form-control" name="descricao" id="descricao" rows="4" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" class="form-control" name="preco" id="preco" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" name="quantidade" id="quantidade" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="imagem" class="form-label">Imagem do produto</label>
                        <input type="file" class="form-control" name="imagem" id="imagem" accept=".jpg, .png, .jpeg, .gif" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>