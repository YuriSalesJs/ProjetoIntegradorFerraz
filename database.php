<?php
    $server_host = "sql210.infinityfree.com";
    $server_user = "if0_39166834";
    $server_password = "m5XPggmiMXl"; 
    $database_name = "if0_39166834_db_ferraz_conecta";

    $conexao = mysqli_connect($server_host, $server_user, $server_password, $database_name);

    
    mysqli_set_charset($conexao, "utf8mb4");// Força a conexão usar o padrão UTF-8
?>