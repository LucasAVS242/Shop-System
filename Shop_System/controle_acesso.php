<?php

    session_start();

    if($_SESSION['nivel_acesso'] === 'COMUM'){
        header("Location: index.php");
        exit;
    }

?>
