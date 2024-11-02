<?php

    // Inicia a sessão
    session_start();

    // Verifica se o usuário está logado
    if(!isset($_SESSION["nome_usuario"]) || !isset($_SESSION["nivel_acesso"])){
        header("Location: index.php");
        exit;
    }

    // Redireciona para a página inicial se for usuário comum
    if($_SESSION['nivel_acesso'] === 'COMUM'){
        header("Location: index.php");
        exit;
    }

?>
