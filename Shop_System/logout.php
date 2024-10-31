<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_nome'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

?>
