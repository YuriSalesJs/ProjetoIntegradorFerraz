<?php
    include 'database.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $nascimento = $_POST['nascimento'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];

    $sql = "INSERT INTO cadastro (nome, email, telefone, cpf, nascimento, senha)
    VALUES ('$nome', '$email', '$telefone', '$cpf', '$nascimento', '$senha')";

    if(mysqli_query($conexao,$sql)){
        header('Location: entrar.php?status=cadastro_sucesso');
    exit();
    } else {
        header('Location: cadastrar.php?status=erro_cadastro');
    exit();
    }

?>