<?php 
    $host = "localhost";
    $dbname = "sistema_shop";
    $username = "root";
    $password = "";

    date_default_timezone_set('America/Sao_Paulo');

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
?>