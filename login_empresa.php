<?php
include 'database.php';

$email = $_POST['email']; // O campo no formulário de login agora pode ser 'email'
$senha_digitada = $_POST['senha'];

// ATUALIZAÇÃO: Busca na coluna 'email' em vez de 'email_login'
$stmt = mysqli_prepare($conexao, "SELECT id, nome_fantasia, senha FROM empresas WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 1) {
    $empresa = mysqli_fetch_assoc($resultado);
    
    if (password_verify($senha_digitada, $empresa['senha'])) {
        session_start();
        session_unset();
        session_destroy();
        session_start();

        $_SESSION['id_empresa'] = $empresa['id'];
        $_SESSION['nome_fantasia'] = $empresa['nome_fantasia'];
        $_SESSION['tipo_usuario'] = 'empresa';

        header('Location: painel_empresa.php');
        exit();
    }
}

header('Location: entrar_empresa.php?status=login_invalido');
exit();
?>