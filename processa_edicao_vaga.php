<?php
session_start();
include 'database.php';

if (!isset($_SESSION['id_empresa']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: entrar_empresa.php');
    exit();
}

// Coleta os dados do formulário
$id_vaga = $_POST['id_vaga'];
$titulo = $_POST['titulo'];
$descricao_completa = $_POST['descricao_completa'];
$salario = $_POST['salario'];
$localizacao = $_POST['localizacao'];
$tipo_contrato = $_POST['tipo_contrato'];
$escolaridade = $_POST['escolaridade'];
$experiencia = $_POST['experiencia'];
$id_empresa = $_SESSION['id_empresa'];

// Prepara a query de UPDATE de forma segura
// A cláusula WHERE com id e empresa_id garante a segurança
$stmt = mysqli_prepare($conexao, 
    "UPDATE vagas SET titulo = ?, descricao_completa = ?, salario = ?, localizacao = ?, tipo_contrato = ?, escolaridade = ?, exp = ? WHERE id = ? AND empresa_id = ?"
);

// Associa os dados à query
mysqli_stmt_bind_param($stmt, "sssssssii", 
    $titulo, $descricao_completa, $salario, $localizacao, $tipo_contrato, $escolaridade, $experiencia, $id_vaga, $id_empresa
);

// Executa e redireciona
if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
    header('Location: painel_empresa.php?status=vaga_editada');
} else {
    // Pode ser um erro ou o usuário não alterou nenhum dado
    header('Location: painel_empresa.php?status=erro_editar');
}

mysqli_stmt_close($stmt);
exit();
?>