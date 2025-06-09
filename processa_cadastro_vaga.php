<?php
session_start();
include 'database.php';

// 1. Verifica se a empresa está logada e se o formulário foi enviado
if (!isset($_SESSION['id_empresa']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: entrar_empresa.php');
    exit();
}

// 2. Coleta os dados do formulário
$titulo = $_POST['titulo'];
$descricao_completa = $_POST['descricao_completa'];
$salario = $_POST['salario'];
$localizacao = $_POST['localizacao'];
$tipo_contrato = $_POST['tipo_contrato'];
$escolaridade = $_POST['escolaridade'];
$experiencia = $_POST['experiencia'];

// 3. Coleta os dados da empresa logada
$empresa_id = $_SESSION['id_empresa'];
$empresa_nome = $_SESSION['nome_fantasia'];

// REMOÇÃO: A variável $idade_default foi removida.
$sexo_default = 'Indiferente';


// 4. Prepara a query de INSERT de forma segura (sem o campo 'idade')
$stmt = mysqli_prepare($conexao, 
    "INSERT INTO vagas (empresa_id, empresa_nome, titulo, descricao_completa, salario, localizacao, tipo_contrato, escolaridade, exp, sexo, data_postagem) 
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())"
);

// 5. Associa os dados à query (com um parâmetro a menos)
mysqli_stmt_bind_param($stmt, "isssssssss", 
    $empresa_id,
    $empresa_nome,
    $titulo,
    $descricao_completa,
    $salario,
    $localizacao,
    $tipo_contrato,
    $escolaridade,
    $experiencia,
    $sexo_default
);

// 6. Executa a query e redireciona
if (mysqli_stmt_execute($stmt)) {
    header('Location: painel_empresa.php?status=vaga_cadastrada');
} else {
    header('Location: painel_empresa.php?status=erro_vaga');
}

mysqli_stmt_close($stmt);
exit();
?>