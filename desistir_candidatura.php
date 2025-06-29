<?php
session_start();
include 'database.php';

// 1. Segurança: Verifica se o usuário é um candidato logado
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'candidato') {
    header('Location: entrar.php');
    exit();
}

// 2. Segurança: Verifica se um ID de candidatura foi fornecido na URL
if (!isset($_GET['id_candidatura']) || !is_numeric($_GET['id_candidatura'])) {
    header('Location: minhas_candidaturas.php?status=erro');
    exit();
}

$id_candidatura = $_GET['id_candidatura'];
$id_usuario = $_SESSION['id_usuario'];

// 3. Prepara a query de DELETE de forma segura
// A cláusula "AND id_usuario = ?" é a segurança MÁXIMA aqui.
// Ela garante que um candidato só possa excluir as SUAS PRÓPRIAS candidaturas.
$stmt = mysqli_prepare($conexao, "DELETE FROM candidaturas WHERE id = ? AND id_usuario = ?");

// 4. Associa os IDs à query
mysqli_stmt_bind_param($stmt, "ii", $id_candidatura, $id_usuario);

// 5. Executa e redireciona com o status apropriado
if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
    // Se uma linha foi afetada, a exclusão deu certo
    header('Location: minhas_candidaturas.php?status=desistencia_sucesso');
} else {
    // Se nenhuma linha foi afetada, ou a candidatura não existe ou não pertence ao usuário
    header('Location: minhas_candidaturas.php?status=erro');
}

mysqli_stmt_close($stmt);
exit();
?>