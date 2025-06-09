<?php
session_start();
include 'database.php';

// 1. Segurança: Verifica se é uma empresa que está logada
if (!isset($_SESSION['id_empresa'])) {
    header('Location: entrar_empresa.php');
    exit();
}

// 2. Segurança: Verifica se um ID de vaga foi fornecido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: painel_empresa.php?status=erro_excluir');
    exit();
}

$id_vaga = $_GET['id'];
$id_empresa = $_SESSION['id_empresa'];

// 3. Prepara a query de DELETE de forma segura
// A MÁGICA DA SEGURANÇA ESTÁ AQUI: "AND empresa_id = ?"
// Isso garante que uma empresa só possa excluir as próprias vagas.
$stmt = mysqli_prepare($conexao, "DELETE FROM vagas WHERE id = ? AND empresa_id = ?");

// 4. Associa os IDs à query
mysqli_stmt_bind_param($stmt, "ii", $id_vaga, $id_empresa);

// 5. Executa e redireciona
if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
    // Se uma linha foi afetada, a exclusão deu certo
    header('Location: painel_empresa.php?status=vaga_excluida');
} else {
    // Se nenhuma linha foi afetada, ou a vaga não existe ou não pertence à empresa
    header('Location: painel_empresa.php?status=erro_excluir');
}

mysqli_stmt_close($stmt);
exit();
?>