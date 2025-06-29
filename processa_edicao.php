<?php
session_start();
include "database.php";

// Segurança: Garante que um candidato logado enviou o formulário
if (!isset($_SESSION['id_usuario']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: entrar.php');
    exit();
}

// --- PARTE 1: PROCESSAMENTO DO UPLOAD DO CURRÍCULO ---

$caminho_cv = null; // Inicia a variável do caminho do CV como nula

// Verifica se um arquivo foi enviado e se não houve erros
if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0) {
    $pasta_uploads = "uploads/";
    $nome_arquivo = basename($_FILES['curriculo']['name']);
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
    $tipos_permitidos = ['pdf', 'doc', 'docx'];

    // Validação de segurança: verifica a extensão do arquivo
    if (in_array($extensao, $tipos_permitidos)) {
        // Cria um nome de arquivo único para evitar sobreposições e conflitos
        $nome_unico = $_SESSION['id_usuario'] . '_' . time() . '.' . $extensao;
        $caminho_completo = $pasta_uploads . $nome_unico;

        // Move o arquivo do diretório temporário para a nossa pasta 'uploads'
        if (move_uploaded_file($_FILES['curriculo']['tmp_name'], $caminho_completo)) {
            $caminho_cv = $caminho_completo; // Guarda o caminho para salvar no banco
        }
    }
}

// --- PARTE 2: ATUALIZAÇÃO DOS DADOS NO BANCO ---

// Coleta os dados de texto do formulário
$id_usuario = $_SESSION['id_usuario'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$resumo = $_POST['resumo_profissional'];
$experiencias = $_POST['experiencia_profissional'];
$formacao = $_POST['formacao_academica'];
$certificacoes = $_POST['certificacoes'];
$habilidades = $_POST['habilidades'];

// Prepara a query de UPDATE
// Se um novo CV foi enviado ($caminho_cv não é nulo), atualiza o caminho. Se não, não mexe.
if ($caminho_cv) {
    $sql = "UPDATE cadastro SET nome=?, email=?, telefone=?, resumo_profissional=?, experiencia_profissional=?, formacao_academica=?, certificacoes=?, habilidades=?, caminho_cv=? WHERE id=?";
    $types = "sssssssssi";
    $params = [$nome, $email, $telefone, $resumo, $experiencias, $formacao, $certificacoes, $habilidades, $caminho_cv, $id_usuario];
} else {
    $sql = "UPDATE cadastro SET nome=?, email=?, telefone=?, resumo_profissional=?, experiencia_profissional=?, formacao_academica=?, certificacoes=?, habilidades=? WHERE id=?";
    $types = "ssssssssi";
    $params = [$nome, $email, $telefone, $resumo, $experiencias, $formacao, $certificacoes, $habilidades, $id_usuario];
}

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, $types, ...$params);

// Executa e redireciona
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['nome_usuario'] = $nome; // Atualiza o nome na sessão, caso tenha mudado
    header('Location: perfil.php?status=sucesso');
} else {
    header('Location: editar_perfil.php?status=erro');
}

mysqli_stmt_close($stmt);
exit();
?>