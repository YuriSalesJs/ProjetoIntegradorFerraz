<?php
include 'database.php';

// Coleta os dados do formulário
$nome_fantasia = $_POST['nome_fantasia'];
$cnpj = $_POST['cnpj'];
$ramo_atividade = $_POST['ramo_atividade'];
$email = $_POST['email']; // <-- Apenas um e-mail agora
$senha_digitada = $_POST['senha'];

$senha_hash = password_hash($senha_digitada, PASSWORD_DEFAULT);

// Query INSERT atualizada para a nova estrutura
$stmt = mysqli_prepare($conexao, 
    "INSERT INTO empresas (nome_fantasia, cnpj, ramo_atividade, email, senha) VALUES (?, ?, ?, ?, ?)"
);

// Associa os dados à query
mysqli_stmt_bind_param($stmt, "sssss", 
    $nome_fantasia, $cnpj, $ramo_atividade, $email, $senha_hash
);

if (mysqli_stmt_execute($stmt)) {
    header('Location: entrar_empresa.php?status=cadastro_sucesso');
} else {
    header('Location: cadastrar_empresa.php?status=erro_cadastro');
}

mysqli_stmt_close($stmt);
exit();
?>