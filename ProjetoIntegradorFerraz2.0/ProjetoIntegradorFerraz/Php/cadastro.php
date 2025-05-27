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
        echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href = 'entrar.php'; // Redireciona para a página 'entrar.php'
        </script>";
    } else {
        echo "<script>
            alert('Falha ao cadastrar no banco de dados.');
        </script>";
    }

?>