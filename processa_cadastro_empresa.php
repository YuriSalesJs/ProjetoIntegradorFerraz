<?php
include 'database.php';

// Coleta os dados do formulário
$nome_fantasia = $_POST['nome_fantasia'];
$cnpj = $_POST['cnpj'];
$ramo_atividade = $_POST['ramo_atividade'];
$email_contato = $_POST['email_contato'];
$email_login = $_POST['email_login'];
$senha_digitada = $_POST['senha'];

// CRIPTOGRAFA A SENHA - A PARTE MAIS IMPORTANTE!
$senha_hash = password_hash($senha_digitada, PASSWORD_DEFAULT);

// Prepara a query de INSERT de forma segura
$stmt = mysqli_prepare($conexao, 
    "INSERT INTO empresas (nome_fantasia, cnpj, ramo_atividade, email_contato, email_login, senha) VALUES (?, ?, ?, ?, ?, ?)"
);

// Associa os dados à query
mysqli_stmt_bind_param($stmt, "ssssss", 
    $nome_fantasia, $cnpj, $ramo_atividade, $email_contato, $email_login, $senha_hash
);

// Executa e verifica
if (mysqli_stmt_execute($stmt)) {
    echo "<script>
        alert('Empresa cadastrada com sucesso!');
        window.location.href = 'entrar_empresa.php';
    </script>";
} else {
    // Adicionado para mostrar um erro mais específico, se houver
    echo "<script>
        alert('Falha ao cadastrar a empresa. Verifique se o CNPJ ou E-mail de Login já não estão em uso.');
        window.location.href = 'cadastrar_empresa.php';
    </script>";
}

mysqli_stmt_close($stmt);
?>