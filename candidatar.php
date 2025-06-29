<?php
session_start();
include "database.php";


// Se não estiver logado ou for uma empresa, redireciona para a página de login de candidato.
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'candidato') {
    header('Location: entrar.php?erro=login_necessario');
    exit();
}

// 2. Verifica se o ID da vaga foi enviado pela URL
if (!isset($_GET['id_vaga']) || !is_numeric($_GET['id_vaga'])) {
    header('Location: index.php?status=vaga_invalida');
    exit();
}

// 3. Coleta o ID do usuário da variável de sessão correta
$id_usuario = $_SESSION['id_usuario'];
$id_vaga = $_GET['id_vaga'];

// 4. VERIFICA SE O USUÁRIO JÁ SE CANDIDATOU A ESTA VAGA
$check_stmt = mysqli_prepare($conexao, "SELECT id FROM candidaturas WHERE id_usuario = ? AND id_vaga = ?");
mysqli_stmt_bind_param($check_stmt, "ii", $id_usuario, $id_vaga);
mysqli_stmt_execute($check_stmt);
$resultado_check = mysqli_stmt_get_result($check_stmt);

if (mysqli_num_rows($resultado_check) > 0) {
    // Se já existe um registro, redireciona de volta com um status de "já candidatado"
    header('Location: detalhes_vaga.php?id=' . $id_vaga . '&status=ja_candidatado');
    exit();
}
mysqli_stmt_close($check_stmt);


// 5. Prepara a query de INSERT de forma segura
$stmt = mysqli_prepare($conexao, "INSERT INTO candidaturas (id_usuario, id_vaga) VALUES (?, ?)");

// 6. Associa os IDs à query
mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_vaga);

// 7. Executa a query e redireciona com base no resultado
if (mysqli_stmt_execute($stmt)) {
    // Se deu certo, redireciona para a página inicial com status de sucesso
    header('Location: index.php?status=candidatura_sucesso');
} else {
    // Se deu erro, redireciona para a página de detalhes com status de erro
    header('Location: detalhes_vaga.php?id=' . $id_vaga . '&status=erro');
}

mysqli_stmt_close($stmt);
exit();
?><?php
session_start();
include "database.php";


// Se não estiver logado ou for uma empresa, redireciona para a página de login de candidato.
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'candidato') {
    header('Location: entrar.php?erro=login_necessario');
    exit();
}

// 2. Verifica se o ID da vaga foi enviado pela URL
if (!isset($_GET['id_vaga']) || !is_numeric($_GET['id_vaga'])) {
    header('Location: index.php?status=vaga_invalida');
    exit();
}

// 3. Coleta o ID do usuário da variável de sessão correta
$id_usuario = $_SESSION['id_usuario'];
$id_vaga = $_GET['id_vaga'];

// 4. VERIFICA SE O USUÁRIO JÁ SE CANDIDATOU A ESTA VAGA
$check_stmt = mysqli_prepare($conexao, "SELECT id FROM candidaturas WHERE id_usuario = ? AND id_vaga = ?");
mysqli_stmt_bind_param($check_stmt, "ii", $id_usuario, $id_vaga);
mysqli_stmt_execute($check_stmt);
$resultado_check = mysqli_stmt_get_result($check_stmt);

if (mysqli_num_rows($resultado_check) > 0) {
    // Se já existe um registro, redireciona de volta com um status de "já candidatado"
    header('Location: detalhes_vaga.php?id=' . $id_vaga . '&status=ja_candidatado');
    exit();
}
mysqli_stmt_close($check_stmt);


// 5. Prepara a query de INSERT de forma segura
$stmt = mysqli_prepare($conexao, "INSERT INTO candidaturas (id_usuario, id_vaga) VALUES (?, ?)");

// 6. Associa os IDs à query
mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_vaga);

// 7. Executa a query e redireciona com base no resultado
if (mysqli_stmt_execute($stmt)) {
    // Se deu certo, redireciona para a página inicial com status de sucesso
    header('Location: index.php?status=candidatura_sucesso');
} else {
    // Se deu erro, redireciona para a página de detalhes com status de erro
    header('Location: detalhes_vaga.php?id=' . $id_vaga . '&status=erro');
}

mysqli_stmt_close($stmt);
exit();
?>