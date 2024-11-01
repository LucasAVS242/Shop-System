<?php
include 'conexao.php';
include 'controle_acesso.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

header("Location: lista_usuarios.php");
exit;
