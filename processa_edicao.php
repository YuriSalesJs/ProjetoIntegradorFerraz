<?php
session_start();
include "database.php";

// Se o usuário não estiver logado ou não enviou dados, não faz nada
if (!isset($_SESSION['id']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: entrar.php');
    exit();
}

// 1. Coleta os dados do formulário
$id_usuario = $_SESSION['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// 2. Prepara a query de UPDATE de forma segura
$stmt = mysqli_prepare($conexao, "UPDATE cadastro SET nome = ?, email = ?, telefone = ? WHERE id = ?");

// 3. Associa os novos dados à query
mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $telefone, $id_usuario);

// 4. Executa a query e verifica se deu certo
if (mysqli_stmt_execute($stmt)) {
    // Se a atualização deu certo, atualiza o nome na sessão
    $_SESSION['nome'] = $nome; 
    // Redireciona para o perfil com status de sucesso
    header('Location: perfil.php?status=sucesso');
} else {
    // Se deu erro, redireciona com status de erro
    header('Location: perfil.php?status=erro');
}

// 5. Fecha a consulta preparada
mysqli_stmt_close($stmt);
exit();
?>